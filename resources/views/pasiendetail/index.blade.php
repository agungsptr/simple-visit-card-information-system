@extends('layouts.app')

@section('title')
Detail Pasien
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
            <strong>Detail Pasien</strong>
            <a href="{{ route('detail.create', ['id'=>$pasien->id]) }}"
                class="btn btn-primary btn-sm float-right">Tambah</a>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary btn-sm mr-2 float-right">Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <strong>No. Pasien</strong>
                </div>
                <div class="col-2">
                    {{$pasien->no_pasien}}
                </div>
                <div class="col-2">
                    <strong>Nama</strong>
                </div>
                <div class="col-2">
                    {{$pasien->nama}}
                </div>
                <div class="col-2">
                    <strong>Telp.</strong>
                </div>
                <div class="col-2">
                    {{$pasien->telp}}
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <strong>Umur</strong>
                </div>
                <div class="col-2">
                    {{$pasien->umur}}
                </div>
                <div class="col-2">
                    <strong>Kelamin</strong>
                </div>
                <div class="col-2">
                    {{$pasien->kelamin}}
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-2">
                    <strong>Alamat</strong>
                </div>
                <div class="col-9">
                    {{$pasien->alamat}}
                </div>
            </div>
            <table class="table table-hover shadow">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Diagnosa</th>
                        <th>Terapi</th>
                        <th>Foto Sebelum</th>
                        <th>Foto Sesudah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tindakans as $tindakan)
                    <tr>
                        <td>{{$tindakan->created_at}}</td>
                        <td>{{$tindakan->diagnosa}}</td>
                        <td>{{$tindakan->terapi}}</td>
                        <td>
                            @if ($tindakan->foto_sebelum)
                            <a href="{{ asset('storage/'.$tindakan->foto_sebelum) }}">
                                <img src="{{ asset('storage/'.$tindakan->foto_sebelum) }}" alt="foto sebelum"
                                    width="100px">
                            </a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            @if ($tindakan->foto_sesudah)
                            <a href="{{ asset('storage/'.$tindakan->foto_sesudah) }}">
                                <img src="{{ asset('storage/'.$tindakan->foto_sesudah) }}" alt="foto sesudah"
                                    width="100px">
                            </a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{route('detail.edit', ['id'=>$pasien->id, 'detail_id'=>$tindakan->id])}}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form
                                onsubmit="return confirm('Yakin menghapus data tindakan {{$tindakan->created_at}} pasien {{ $pasien->nama }} ?')"
                                class="d-inline"
                                action="{{ route('detail.destroy', ['id' => $pasien->id, 'detail_id'=>$tindakan->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" value="Delete" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection