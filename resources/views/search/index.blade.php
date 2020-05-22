@extends('layouts.app-search')

@section('head')
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
<link href="{{ asset('vendor/colorlib-search/css/main.css') }}" rel="stylesheet" />
@endsection

@section('content-no-card')
<div class="col-md-12">
    <div class="s130">
        <form action="{{route('search.index')}}">
            <div class="inner-form">
                <div class="input-field first-wrap">
                    <div class="svg-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                            </path>
                        </svg>
                    </div>
                    <input name="q" value="{{Request::get('q')}}" id="search" type="text"
                        placeholder="Nama Pasien, No Pasien, Telepon" />
                </div>
                <div class="input-field second-wrap">
                    <button class="btn-search" type="submit">CARI</button>
                </div>
            </div>
            <!-- <span class="info">ex. Nama Pasien, No Pasien, Telepon</span> -->

            @if (isset($result))
            @foreach ($result as $r)
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                <a href="{{route('detail.index', ['id'=>$r->id])}}" style="text-decoration: none">
                        <div class="card">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td style="width: 80px">{{$r->id}}</td>
                                        <td style="width: 110px">{{$r->telp}}</td>
                                        <td style="width: 200px">{{$r->nama}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-1"></div>
            </div>
            @endforeach
            @endif
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('vendor/colorlib-search/js/extention/choices.js') }}"></script>
@endsection