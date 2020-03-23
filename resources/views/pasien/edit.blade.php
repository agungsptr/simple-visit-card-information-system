@extends('layouts.app')

@section('title')
Pasien
@endsection

@section('title-card')
Edit Pasien
@endsection

@section('pasien-status')
active
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <form action="{{ route('pasien.update', ['pasien'=>$pasien->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="">No Pasien</label>
                <input name="no_pasien" type="number" class="form-control" readonly value="{{ $pasien->no_pasien }}">
            </div>
            <div class="form-group">
                <label for="">Nama Pasien</label>
                <input name="nama" type="text" class="form-control {{$errors->first('nama') ? 'is-invalid':''}}"
                    value="{{ $pasien->nama }}">
                @error('nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="kelamin" id="" class="form-control {{$errors->first('kelamin') ? 'is-invalid':''}}">
                    <option {{ $pasien->kelamin == 'L' ? 'selected':'' }} value="L">Pria</option>
                    <option {{ $pasien->kelamin == 'P' ? 'selected':'' }} value="P">Wanita</option>
                </select>
                @error('kelamin')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Usia</label>
                <input name="umur" type="number" class="form-control {{$errors->first('umur') ? 'is-invalid':''}}"
                    value="{{ $pasien->umur }}">
                @error('umur')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nomor Telepon</label>
                <input name="telp" type="number" maxlength="15"
                    class="form-control {{$errors->first('telp') ? 'is-invalid':''}}" value="{{ $pasien->telp }}">
                @error('telp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="3"
                    class="form-control {{$errors->first('alamat') ? 'is-invalid':''}}">{{ $pasien->alamat }}</textarea>
                @error('alamat')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-md float-right">Simpan</button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary btn-md float-right mr-2">Kembali</a>
        </form>
    </div>
</div>
@endsection