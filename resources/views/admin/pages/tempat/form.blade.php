@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Form Tempat</div>

                    <div class="card-body">
                        <form action="{{ @!$tempat ? route('admin.tempats.store') : route('admin.tempats.update', $tempat) }}" method="post">
                            @csrf
                            @isset($tempat)
                                {{ method_field('PUT')}}
                            @endisset
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Nama Tempat</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('nama_tempat') is-invalid @enderror" name="nama_tempat" value="{{ old('nama_tempat', @$tempat ? $tempat->nama_tempat : '') }}">

                                    @error('nama_tempat')
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
