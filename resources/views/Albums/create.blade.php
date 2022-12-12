@extends('Layouts.layout')

@section('body')

<div class="container-fluid">

    <div class="animated fadeIn">
        <form action="{{ Route('album.store') }}" method="POST">
            @csrf

            <div class="row">


                <div class="card">
                    <div class="card-header">
                        <strong>Create Album</strong>
                    </div>
                    <div class="card-block">
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="name" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                            Submit</button>
                    </div>



                </div>
        </form>
    </div>
</div>

@endsection
