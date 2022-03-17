@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Kategori') }}</div>

                <div class="card-body">
                    <form action="{{ (!isset($kategori->id)) ? route('kategori.store') : route('kategori.update', $kategori->id) }}" method="post">
                        @csrf
                        @isset($kategori->id)
                            {{ method_field('PUT')}}
                        @endisset
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Nama Kategori') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">

                                @error('nama_kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Keterangan</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan', $kategori->keterangan) }}</textarea>

                                @error('keterangan')
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
