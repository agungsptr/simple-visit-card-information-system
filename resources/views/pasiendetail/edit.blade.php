@extends('layouts.app')

@section('title')
Edit Tindakan
@endsection

@section('content')
<div class="container">
    @if(session('status'))
    <div class="alert alert-success">
        Berhasil mengedit tindakan pada Pasien <strong>{{session('status')}}</strong>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-header">
            <strong>Edit Detail Pasien</strong>
        </div>
        <div class="card-body">
            <form action="{{route('detail.update', ['id'=>$tindakan->pasien_id, 'detail_id'=>$tindakan->id])}}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Foto Sebelum</label>
                            <input name="foto_sebelum" type="file" class="form-control-file"
                                value="{{$tindakan->foto_sebelum}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Foto Sesudah</label>
                            <input name="foto_sesudah" type="file" class="form-control-file"
                                value="{{$tindakan->foto_sesudah}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <textarea name="diagnosa" id="" cols="30" rows="3"
                        class="form-control">{{$tindakan->diagnosa}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Therapi</label>
                    <textarea name="terapi" id="" cols="30" rows="3"
                        class="form-control">{{$tindakan->terapi}}</textarea>
                </div>
                <input name="pasien_id" type="hidden" value="{{$tindakan->pasien_id}}">
                <button type="submit" class="btn btn-primary btn-md float-right">Simpan</button>
                <a href="{{route('detail.index', ['id'=>$tindakan->pasien_id])}}" class="btn btn-secondary btn-md float-right mr-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection