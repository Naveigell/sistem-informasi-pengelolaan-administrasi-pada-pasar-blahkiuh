@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Pedagang') }}</div>

                <div class="card-body">
                    <form action="{{ (!isset($pedagang->id)) ? route('pedagang.store') : route('pedagang.update', $pedagang->id) }}" method="post">
                        @csrf
                        @isset($pedagang->id)
                            {{ method_field('PUT')}}
                        @endisset
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Nama Pedagang') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $pedagang->nama) }}">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $pedagang->email) }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Lokasi') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi', $pedagang->lokasi) }}">

                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('No. Telp') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $pedagang->no_telp) }}">

                                @error('no_telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Tgl. Bergabung') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control datepicker @error('tgl_bergabung') is-invalid @enderror" name="tgl_bergabung" value="{{ old('tgl_bergabung', $pedagang->tgl_bergabung) }}">

                                @error('tgl_bergabung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <input type="submit" value="Simpan" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
