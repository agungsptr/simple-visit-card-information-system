@extends('layouts.app')

@section('title')
Create Pasien
@endsection

@section('content')
<div class="container">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form action="{{ route('pasien.store') }}" method="POST">
        @csrf

        <div class="card shadow">
            <div class="card-header">
                <strong>Kartu Pasien</strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">No Pasien</label>
                    <input name="no_pasien" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nama Pasien</label>
                    <input name="nama" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="kelamin" id="" class="form-control">
                        <option value="L">Pria</option>
                        <option value="P">Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Usia</label>
                    <input name="umur" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input name="telp" type="number" maxlength="15" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-md float-right">Simpan</button>
                <a href="{{ route('pasien.index') }}" class="btn btn-secondary btn-md float-right mr-2">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection