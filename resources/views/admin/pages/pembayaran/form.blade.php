@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Pembayaran') }}</div>

                <div class="card-body">
                    <form action="{{ (!isset($pembayaran->id)) ? route('admin.pembayaran.store') : route('admin.pembayaran.update', $pembayaran->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($pembayaran->id)
                            {{ method_field('PUT')}}
                        @endisset

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Kategori pembayaran') }}</label>

                            <div class="col-md-6">

                                <select class="form-select select2" name="kategori_id">
                                    <option value="">Tidak ada</option>
                                    @foreach($kategori as $option)
                                        <option value="{{ $option->id }}" {{ $option->id == old('kategori_id', $pembayaran->kategori_id) ? 'selected' : '' }}>{{ ucwords($option->nama_kategori) }}</option>
                                    @endforeach
                                </select>

                                @error('kategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (auth()->guard('web')->check())
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Pedagang') }}</label>

                                <div class="col-md-6">

                                    <select class="form-select select2" name="pedagang_id">
                                        <option value="">Tidak ada</option>
                                        @foreach($pedagang as $option)
                                            <option value="{{ $option->id }}" {{ $option->id == old('pedagang_id', $pembayaran->pedagang_id) ? 'selected' : '' }}>{{ $option->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('pedagang_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control datepicker @error('tgl') is-invalid @enderror" name="tgl" value="{{ old('tgl', $pembayaran->tgl) }}">

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
                                <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal', $pembayaran->nominal) }}">

                                @error('nominal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Bukti Pembayaran') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran" value="{{ old('bukti_pembayaran', $pembayaran->bukti_pembayaran) }}">

                                @error('bukti_pembayaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Keterangan</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>

                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (auth()->guard('web')->check())
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">

                                <select class="form-select select2" name="status">
                                    <option value="0" {{ old('status', $pembayaran->status) == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ old('status', $pembayaran->status) == 1 ? 'selected' : '' }}>Acc</option>
                                    <option value="2" {{ old('status', $pembayaran->status) == 2 ? 'selected' : '' }}>Ditolak</option>

                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif

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
