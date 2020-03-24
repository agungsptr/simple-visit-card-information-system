@extends('layouts.app')

@section('title')
Manage User
@endsection

@section('title-card')
Tambah User
@endsection

@section('menu-user-status')
active
@endsection

@section('menu-user-tambah-status')
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

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Nama</label>
                <input name="name" type="text""
                    class=" form-control {{$errors->first('name') ? 'is-invalid':''}}" value="{{old('name')}}" required>
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input name="username" type="text" class="form-control {{$errors->first('username') ? 'is-invalid':''}}"
                    value="{{old('username')}}" required>
                @error('username')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input name="password" type="password"
                    class="form-control {{$errors->first('password') ? 'is-invalid':''}}" required>
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input name="password_conf" type="password"
                    class="form-control {{$errors->first('password_conf') ? 'is-invalid':''}}" required>
                @error('password_conf')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="role" id="" class="form-control {{$errors->first('role') ? 'is-invalid':''}}" required>
                    <option {{old('role') == 'user' ? 'SELECTED':''}} value="user">User</option>
                    <option {{old('role') == 'admin' ? 'SELECTED':''}} value="admin">Admin</option>
                </select>
                @error('role')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nomor Telepon</label>
                <input name="telp" type="text" class="form-control {{$errors->first('telp') ? 'is-invalid':''}}"
                    onkeypress="isInputNumber(event)" value="{{old('telp')}}" maxlength="15">
                @error('telp')
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