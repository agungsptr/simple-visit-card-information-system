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
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Foto Sebelum</label>
                            <div class="mb-2">
                                @if ($tindakan->foto_sebelum)
                                <a href="{{ asset('storage/'.$tindakan->foto_sebelum) }}">
                                    <img src="{{ asset('storage/'.$tindakan->foto_sebelum) }}" alt="foto sebelum"
                                        width="300px">
                                </a>
                                @endif
                            </div>
                            <input name="foto_sebelum" type="file" class="form-control-file"
                                value="{{$tindakan->foto_sebelum}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Foto Sesudah</label>
                            <div class="mb-2">
                                @if ($tindakan->foto_sesudah)
                                <a href="{{ asset('storage/'.$tindakan->foto_sesudah) }}">
                                    <img src="{{ asset('storage/'.$tindakan->foto_sesudah) }}" alt="foto sesudah"
                                        width="300px">
                                </a>
                                @endif
                            </div>
                            <input name="foto_sesudah" type="file" class="form-control-file"
                                value="{{$tindakan->foto_sesudah}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Diagnosa</label>
                    <textarea name="diagnosa" id="" cols="30" rows="3"
                        class="form-control {{$errors->first('diagnosa') ? 'is-invalid':''}}"
                        required>{{$tindakan->diagnosa}}</textarea>
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
                        required>{{$tindakan->terapi}}</textarea>
                    @error('terapi')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <input name="pasien_id" type="hidden" value="{{$tindakan->pasien_id}}">
                <button type="submit" class="btn btn-primary btn-md float-right">Simpan</button>
                <a href="{{route('detail.index', ['id'=>$tindakan->pasien_id])}}"
                    class="btn btn-secondary btn-md float-right mr-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection