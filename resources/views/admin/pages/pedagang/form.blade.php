@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Pedagang') }}</div>

                <div class="card-body">
                    <form action="{{ (!isset($pedagang->id)) ? route('admin.pedagang.store') : route('admin.pedagang.update', $pedagang->id) }}" method="post">
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
                                <select name="tempat_id" class="form-control @error('tempat_id') is-invalid @enderror select2" id="">
                                    <option value="">-- Nothing Selected --</option>
                                    @foreach($tempats as $tempat)
                                        <option value="{{ $tempat->id }}" @if (old('tempat_id', @$pedagang ? $pedagang->tempat_id : '') === $tempat->id) selected @endif>{{ $tempat->nama_tempat }}</option>
                                    @endforeach
                                </select>
                                @error('tempat_id')
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
                            <label class="col-md-4 col-form-label text-md-end">Jenis Dagangan</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('jenis_dagangan') is-invalid @enderror" name="jenis_dagangan" value="{{ old('jenis_dagangan', $pedagang->jenis_dagangan) }}">

                                @error('jenis_dagangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Tgl. Bergabung') }}</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control @error('tgl_bergabung') is-invalid @enderror" readonly name="tgl_bergabung" value="{{ old('tgl_bergabung', date('Y-m-d')) }}">

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
