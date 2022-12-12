@extends('Layouts.layout')
@section('body')

@foreach($album->images as $image)

<img src="{{ $image->getMedia('img')->first()->getUrl() }}" /width="120">

@endforeach

<div class="container-fluid">

    <div class="animated fadeIn">
        <form action="{{ url('album/add-image') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <strong>Add Image To Album / {{$album->name}}</strong>
                    </div>
                    <input type="hidden" name="id" class="form-control" value="{{$album->id}}" placeholder="id">
                    <div class="card-block">
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="name" required>
                        </div>
                    </div>

                    <div class="card-block">
                        <div class="form-group col-md-12">
                            <label>Image</label>
                            <input type="file" name="img" class="form-control" placeholder="image" required>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                            Submit</button>
                        <a href="{{url('/album/index')}}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                            cancle</a>
                    </div>



                </div>
        </form>
    </div>
</div>

@endsection
