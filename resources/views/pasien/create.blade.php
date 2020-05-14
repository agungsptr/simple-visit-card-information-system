@extends('layouts.app')

@section('title')
Pasien
@endsection

@section('title-card')
Tambah Pasien
@endsection

@section('menu-pasien-status')
active
@endsection

@section('menu-pasien-tambah-status')
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

        <form action="{{ route('pasien.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">No Pasien</label>
                <input name="no_pasien" type="text" onkeypress="isInputNumber(event)"
                    class="form-control {{$errors->first('no_pasien') ? 'is-invalid':''}}" value="{{old('no_pasien')}}"
                    required maxlength="18">
                @error('no_pasien')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nama Pasien</label>
                <input name="nama" type="text" class="form-control {{$errors->first('nama') ? 'is-invalid':''}}"
                    value="{{old('nama')}}" required maxlength="190">
                @error('nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="kelamin" id="" class="form-control {{$errors->first('kelamin') ? 'is-invalid':''}}">
                    <option {{old('kelamin') == 'L' ? 'SELECTED':''}} value="L">Pria</option>
                    <option {{old('kelamin') == 'P' ? 'SELECTED':''}} value="P">Wanita</option>
                </select>
                @error('kelamin')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Usia</label>
                <input name="umur" type="text" class="form-control {{$errors->first('umur') ? 'is-invalid':''}}"
                    onkeypress="isInputNumber(event)" value="{{old('umur')}}" maxlength="3" required>
                @error('umur')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nomor Telepon</label>
                <input name="telp" type="text" class="form-control {{$errors->first('telp') ? 'is-invalid':''}}"
                    onkeypress="isInputNumber(event)" value="{{old('telp')}}" maxlength="15" required>
                @error('telp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="3"
                    class="form-control {{$errors->first('alamat') ? 'is-invalid':''}}"
                    required>{{old('alamat')}}</textarea>
                @error('alamat')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-md float-right">Simpan</button>
        </form>
    </div>
</div>
@endsection