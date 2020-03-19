@extends('layouts.app')

@section('title')
List Pasien
@endsection

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pasien->nama}}</td>
                        <td>{{$pasien->kelamin}}</td>
                        <td>{{$pasien->telp}}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{ route('pasien.edit', ['pasien'=>$pasien->id]) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('Yakin menghapus data pasien {{ $pasien->nama }} ?')"
                                class="d-inline" action="{{ route('pasien.destroy', ['pasien' => $pasien->id ]) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" value="Delete" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
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