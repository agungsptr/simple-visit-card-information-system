@extends('layouts.app')

@section('title')
Edit Pasien
@endsection

@section('content')
<div class="container">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form action="{{ route('pasien.update', ['pasien'=>$pasien->id]) }}" method="POST">
        @csrf
        <input name="_method" type="hidden" value="PUT">

        <div class="card shadow">
            <div class="card-header">
                <strong>Kartu Pasien</strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Pasien</label>
                    <input name="nama" type="text" class="form-control" value="{{ $pasien->nama }}">
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="kelamin" id="" class="form-control">
                        <option {{ $pasien->kelamin == 'L' ? 'selected':'' }} value="L">Pria</option>
                        <option {{ $pasien->kelamin == 'P' ? 'selected':'' }}value="P">Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Usia</label>
                    <input name="umur" type="number" class="form-control" value="{{ $pasien->umur }}">
                </div>
                <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input name="telp" type="number" maxlength="15" class="form-control" value="{{ $pasien->telp }}">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="3"
                        class="form-control">{{ $pasien->alamat }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-md float-right">Simpan</button>
                <a href="{{ route('pasien.index') }}" class="btn btn-secondary btn-md float-right mr-2">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection