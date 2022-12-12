@extends('Layouts.layout')

@section('body')


<div class="tab1cards">
    @foreach($album->images as $image)

    <div class="cardd">
        <img src="{{ $image->getMedia('img')->first()->getUrl() }}" style="width:25%">
        <div class="containerr_">
            <h4><b>{{$image->name}}</b></h4>
            <a href="{{url('image/delete/'.$image->id)}}" class="edit btn btn-danger btn-sm">
                <i class="fa fa-trash"></i></a>

        </div>
    </div>

    @endforeach
</div>

<div class="container-fluid">

    <div class="animated fadeIn">
        <form action="{{ url('album/edit') }}" method="post" enctype="multipart/form-data">
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
                        <strong>Edit Album {{$album->name}}</strong>
                    </div>
                    <input type="hidden" name="id" class="form-control" value="{{$album->id}}" placeholder="id">
                    <div class="card-block">
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="name" value="{{$album->name}}" required>
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
