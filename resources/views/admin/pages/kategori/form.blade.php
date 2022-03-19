@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Form Kategori') }}</div>

                    <div class="card-body">
                        <form action="{{ @!$kategori ? route('admin.kategori.store') : route('admin.kategori.update', $kategori) }}" method="post">
                            @csrf
                            @isset($kategori->id)
                                {{ method_field('PUT')}}
                            @endisset

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Nama Kategori') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" value="{{ old('nama_kategori', @$kategori ? $kategori->nama_kategori : '') }}">

                                    @error('nama_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"></label>

                                <div class="col-md-6">

                                    <div class="form-check form-check-inline">
                                        <div class="custom-control custom-checkbox">
                                            <input name="is_pedagang" type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Pedagang?</label>
                                        </div>
                                    </div>
                                    @error('is_pedagang')
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
