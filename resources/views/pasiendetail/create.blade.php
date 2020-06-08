@extends('layouts.app')

@section('title')
Pasien
@endsection

@section('title-card')
Tambah Tindakan
@endsection

@section('menu-pasien-status')
active
@endsection

@section('menu-pasien-list-status')
active
@endsection

@section('content')
<div class="container">
    @if(session('status'))
    <div class="alert alert-success">
        Berhasil menambahkan tindakan pada Pasien <strong>{{session('status')}}</strong>
    </div>
    @endif

    <form action="{{ route('detail.store', ['id'=>$id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Foto Sebelum</label>
                    <input name="foto_sebelum" type="file" class="form-control-file" accept="image/*">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Foto Sesudah</label>
                    <input name="foto_sesudah" type="file" class="form-control-file" accept="image/*">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Diagnosa</label>
            <textarea name="diagnosa" id="" cols="30" rows="3"
                class="form-control {{$errors->first('diagnosa') ? 'is-invalid':''}}"
                required>{{old('diagnosa')}}</textarea>
            @error('diagnosa')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Therapi</label>
            <textarea name="terapi" id="" cols="30" rows="3"
                class="form-control {{$errors->first('terapi') ? 'is-invalid':''}}"
                required>{{old('terapi')}}</textarea>
            @error('terapi')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <input name="pasien_id" type="hidden" value="{{$id}}">
        <button type="submit" class="btn btn-primary btn-md float-right">Simpan</button>
        <a href="{{ route('detail.index', ['id'=>$id]) }}" class="btn btn-secondary btn-md mr-2 float-right">Kembali</a>
    </form>
</div>
@endsection