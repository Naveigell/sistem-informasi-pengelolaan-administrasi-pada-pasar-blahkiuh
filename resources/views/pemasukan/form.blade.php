@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Pemasukan') }}</div>

                <div class="card-body">
                    <form action="{{ (!isset($pemasukan->id)) ? route('pemasukan.store') : route('pemasukan.update', $pemasukan->id) }}" method="post">
                        @csrf
                        @isset($pemasukan->id)
                            {{ method_field('PUT')}}
                        @endisset

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Kategori Pemasukan') }}</label>

                            <div class="col-md-6">

                                <select class="form-select select2" name="kategori_id">
                                    <option value="">Tidak ada</option>
                                    @foreach($kategori as $option)
                                        <option value="{{ $option->id }}" {{ $option->id == old('kategori_id', $pemasukan->kategori_id) ? 'selected' : '' }}>{{ $option->nama_kategori }}</option>
                                    @endforeach
                                </select>

                                @error('kategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Pedagang') }}</label>

                            <div class="col-md-6">

                                <select class="form-select select2" name="pedagang_id">
                                    <option value="">Tidak ada</option>
                                    @foreach($pedagang as $option)
                                        <option value="{{ $option->id }}" {{ $option->id == old('pedagang_id', $pemasukan->pedagang_id) ? 'selected' : '' }}>{{ $option->nama }}</option>
                                    @endforeach
                                </select>

                                @error('pedagang_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control datepicker @error('tgl') is-invalid @enderror" name="tgl" value="{{ old('tgl', $pemasukan->tgl) }}">

                                @error('tgl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Nominal') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal', $pemasukan->nominal) }}">

                                @error('nominal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Keterangan</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan', $pemasukan->keterangan) }}</textarea>

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
