@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Pengeluaran') }}</div>

                <div class="card-body">
                    <form action="{{ (!isset($pengeluaran->id)) ? route('admin.pengeluaran.store') : route('admin.pengeluaran.update', $pengeluaran->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($pengeluaran->id)
                            {{ method_field('PUT')}}
                        @endisset
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Nama Pengeluaran') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nama_pengeluaran') is-invalid @enderror" name="nama_pengeluaran" value="{{ old('nama_pengeluaran', $pengeluaran->nama_pengeluaran) }}">

                                @error('nama_pengeluaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control datepicker @error('tgl') is-invalid @enderror" name="tgl" value="{{ old('tgl', $pengeluaran->tgl) }}">

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
                                <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal', $pengeluaran->nominal) }}">

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
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan', $pengeluaran->keterangan) }}</textarea>

                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Bukti Pengeluaran</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control @error('bukti_pengeluaran') is-invalid @enderror" name="bukti_pengeluaran" value="{{ old('bukti_pengeluaran', $pengeluaran->bukti_pengeluaran) }}">

                                @error('bukti_pengeluaran')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <input type="submit" onclick="return confirm('Apakah data ini sudah benar?');" value="Simpan" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
