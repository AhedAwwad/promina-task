@extends('Layouts.layout')

@section('body')


<div class="container-fluid">
    <input type="hidden" name="albumID" id="albumID" value="{{$album_id}}">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">

                <i class="fa fa-align-justify"></i> Albums Table To Transfer
            </div>

            <div class="card-block">
                <table class="table table-striped" id="table_id">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($albums as $album)
                        <tr>
                            <td>{{$album->id}}</td>
                            <td>{{$album->name}}</td>
                            <td><a href="{{ url('/album/transfer-images/'.$album_id.'/'.$album->id)}}" class="edit btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i></a></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>



@endsection
