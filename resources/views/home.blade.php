@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid">
                            </div>
                            <div class="col-md-10">
                                <p class="mt-3">
                                    Selamat Datang Di Sistem Informasi Pengelolaan Data Administrasi Pedagang Pada Pasar Tradisional Blahkiuh Berbasis Web.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
