@extends('Layouts.layout')

@section('body')

<div class="container-fluid">
    <a href="{{ url('/album/create')}}" class="edit btn btn-success" style="margin-right: 20px;"> Add New Album <i class="fa fa-plus"></i></a>
    <a href="{{ url('/chart')}}" class="edit btn btn-info" style="margin-right: 20px;"> Show Chart <i class="fa fa-bar-chart"></i></a>

</div>
<div class="container-fluid">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">

                <i class="fa fa-align-justify"></i> Albums Table
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


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ Route('album.delete') }}" method="POST">
            <div class="modal-content">

                <div class="modal-body">
                    @csrf

                    <div class="form-group">
                        <p>Are You Sure for Delete ??</p>
                        @csrf
                        <input type="hidden" name="id" id="id">
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete </button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal fade" id="deleteAllmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" method="POST" id="form-delete">
            <div class="modal-content">

                <div class="modal-body">

                @csrf
                    <div class="form-group">
                        <p>Album is not empty ..!!</p>

                        <input type="hidden" name="id" id="id">
                    </div>
                    @csrf


                </div>
                <div class="modal-footer">
                    <button type="submit" id="delete-images" class="btn btn-danger">Delete album with images</button>
                    <button type="submit" id="transfer-images" class="btn btn-info">transfer to another album </a>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




@endsection
@push('javascripts')
<script type="text/javascript">
    $(function() {
        var table = $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ Route('album.all') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',


                }
            ]
        });

    });



    $('#table_id tbody').on('click', '#deleteBtn', function(argument) {
        var id = $(this).attr("data-id");
        console.log(id);
        $('#deletemodal #id').val(id);
    })


    $('#table_id tbody').on('click', '#deleteBtn', function(argument) {
        var id = $(this).attr("data-id");
      //  console.log(id);
        $('#deleteAllmodal #id').val(id);
    })





    $('#delete-images').on('click', function(e) {

        $('#form-delete').attr('action', '/album/delete-with-images');
       // form.action = '';

    });


    $('#transfer-images').on('click', function(e) {

$('#form-delete').attr('action', '/album/transfer');
// form.action = '';

});
</script>

@endpush
