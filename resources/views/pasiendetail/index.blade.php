@extends('layouts.app')

@section('title')
Pasien
@endsection

@section('title-card')
Detail Pasien
@endsection

@section('menu-pasien-status')
active
@endsection

@section('menu-pasien-list-status')
active
@endsection

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <div class="mb-4">
        <div class="row mb-2">
            <div class="col-2">
                <strong>No. Pasien</strong>
                <input type="text" value="{{$pasien->id}}" readonly class="form-control">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-8">
                <strong>Nama</strong>
                <input type="text" value="{{$pasien->nama}}" readonly class="form-control">
            </div>
            <div class="col-2">
                <strong>Umur</strong>
                <input type="text" value="{{$pasien->umur}}" readonly class="form-control">
            </div>
            <div class="col-2">
                <strong>Kelamin</strong>
                <input type="text" value="{{$pasien->kelamin}}" readonly class="form-control">
            </div>

        </div>
        <div class="row mb-4">
            <div class="col-5">
                <strong>Alamat</strong>
                <textarea name="" id="" cols="30" rows="3" class="form-control" readonly>{{$pasien->alamat}}</textarea>
            </div>
            <div class="col-3">
                <strong>Telp.</strong>
                <input type="text" value="{{$pasien->telp}}" readonly class="form-control">
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover" style="width:100%" id="table_id">
            <thead>
                <tr>
                    <th style="width: 80px">Tanggal</th>
                    <th>Diagnosa</th>
                    <th>Terapi</th>
                    <th style="width: 120px">Foto Sebelum</th>
                    <th style="width: 120px">Foto Sesudah</th>
                    <th style="width: 120px">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('detail.create', ['id'=>$pasien->id]) }}"
                class="btn btn-primary btn-md float-right">Tambah</a>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary btn-md mr-2 float-right">Kembali</a>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
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
            ajax:"{{ route('getdata.pasiendetail', ['id'=>"+$pasien->id+"]) }}",
            columns:[
                {data:'tanggal'},
                {data:'diagnosa'},
                {data:'terapi'},
                {data:'img_foto_sebelum', sortable:false},
                {data:'img_foto_sesudah', sortable:false},
                {data:'aksi', sortable:false}
            ],
            searching:false,
            order:[[01, "desc"]],
        });

        $('#table_id tbody').on('click', 'button', function () {
            var url = $(this).data('remote');
            $('#modal-delete').modal('show');
            $('#form-delete').attr('action', url);

            var tr = $(this).closest('tr');
            var row = table.row(tr).data();
            document.getElementById('modal-body').innerHTML = 'Apakah anda yakin menghapus data pasien <strong>' + row.tanggal + '</strong> ?';
        });
    });
</script>
@endsection