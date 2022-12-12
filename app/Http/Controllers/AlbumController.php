<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Redis;

class AlbumController extends Controller
{
    public function getAllAlbums()
    {
        $data = Album::select('*');
        //dd($data);

        return  DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
            $image_count = Image::where('album_id', $row->id)->count();
            $btn = '<a href="' . url('album/edit', $row->id) .
                '"  class="edit btn btn-success btn-sm" >
                <i class="fa fa-edit"></i></a>

                <a href="' . url('album/' . $row->id . '/add-image') .
                '"  class="edit btn btn-info btn-sm" >
                <i class="fa fa-plus"></i></a>';
            if ($image_count === 0) {
                $btn .=  ' <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal">
          <i class="fa fa-trash"></i></a>';
            } else {
                $btn .= ' <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deleteAllmodal">
            <i class="fa fa-trash"></i></a>';
            }

            return $btn;
        })
            ->rawColumns(['action'])->make(true);
    }

    public function getAllAlbumsin()
    {
        return view('Albums.index');
    }

    public function edit($id)
    {
        $album = Album::with('Images')->where('id', $id)->first();
        return view('Albums.edit', compact('album'));
    }

    public function update(Request $request)
    {
        $album = Album::find($request->id);
        $album->name = $request->name;
        if ($album->save()) {
            $notification = array(
                'message' => 'Updated successfully',
                'alert-type' => 'success'
            );

            return  redirect('album/index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Not updated. An error occurred',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function deleteImage($id)
    {
        $image = Image::where('id', $id)->first();
        $image->delete();
        return  redirect()->back();
    }



    public function delete(Request $request)
    {
        $album = Album::find($request->id);

        if ($album->delete()) {

            $notification = array(
                'message' => 'Deleted successfully',
                'alert-type' => 'success'
            );

            return  redirect('album/index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Not deleted. An error occurred',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function create()
    {
        return view('Albums.create');
    }

    public function store(Request $request)
    {
        $album = new Album();
        $album->name = $request->name;
        if ($album->save()) {
            $notification = array(
                'message' => 'Added successfully',
                'alert-type' => 'success'
            );

            return  redirect('album/index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Not added. An error occurred',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function addImage($id)
    {
        $album = Album::with('Images')->where('id', $id)->first();
        return view('Albums.add-image', compact('album'));
    }

    public function storeImage(Request $request)
    {
        $image = new Image();
        $image->name = $request->name;
        $image->album_id = $request->id;
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $image->addMediaFromRequest('img')->toMediaCollection('img');
        }
        if ($image->save()) {
            $notification = array(
                'message' => 'Added successfully',
                'alert-type' => 'success'
            );

            return redirect('album/' . $request->id . '/add-image')->with($notification);
        } else {
            $notification = array(
                'message' => 'Not added. An error occurred',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }


    public function deleteWithImages(Request $request)
    {
        $album = Album::with('Images')->where('id', $request->id)->first();
        foreach ($album->images as $image) {
            $image = Image::where('id', $image->id)->delete();
        }
        //$images = Image::where('album_id',$request->id)->delete();

        $album->delete();

        $notification = array(
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function getAlbumToTransfer(Request $request)
    {
        $album_id = $request->id;
        $albums = Album::get();
        return view('Albums.album-list-transfer', compact('album_id', 'albums'));
    }

    public function transferImages($abum_from, $album_to)
    {

        $images = Image::where('album_id', $abum_from)->get();

        foreach ($images as $image) {

            $image = Image::find($image->id);
            $image->album_id = $album_to;
            $image->save();
        }
        $notification = array(
            'message' => 'Images Transferd successfully',
            'alert-type' => 'success'
        );
        return  redirect('album/index')->with($notification);
    }

    public function handleChart()
    {
        $image_count = Image::select(\DB::raw("COUNT(*) as count"))

            ->groupBy('album_id')
            ->pluck('count');
        $album = Album::get()->pluck('id');

        return view('chart', compact('image_count', 'album'));
    }
}
