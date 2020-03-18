@extends('layouts.app')

@section('title')
List Pasien
@endsection

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <strong>Daftar Pasien</strong>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelamin</th>
                        <th>Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pasien->nama}}</td>
                        <td>{{$pasien->kelamin}}</td>
                        <td>{{$pasien->telp}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$pasiens->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection