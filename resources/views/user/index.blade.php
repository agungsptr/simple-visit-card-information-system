@extends('layouts.app')

@section('title')
Manage User
@endsection

@section('title-card')
List User
@endsection

@section('menu-user-status')
active
@endsection

@section('menu-user-list-status')
active
@endsection

@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('warning')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-12">
        <table class="table table-striped table-bordered table-hover" style="width:100%" id="table_id">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th style="width: 100px">Role</th>
                    <th style="width: 140px">Telepon</th>
                    <th style="width: 165px">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="" id="form-delete" class="form-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="form-btn_delete">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready( function () {
        var table = $('#table_id').DataTable({
            processing:true,
            serverside:true,
            ajax:"{{ route('getdata.user') }}",
            columns:[
                {data:'name'},
                {data:'username'},
                {data:'role', sortable:false, searchable:false},
                {data:'telp'},
                {data:'aksi', sortable:false},
            ],
        });

        $('#table_id tbody').on('click', 'button', function () {
            var url = $(this).data('remote');
            $('#modal-delete').modal('show');
            $('#form-delete').attr('action', url);

            var tr = $(this).closest('tr');
            var row = table.row(tr).data();
            document.getElementById('modal-body').innerHTML = 'Apakah anda yakin menghapus user <strong>' + row.name + '</strong> ?';
        });
    });
</script>
@endsection