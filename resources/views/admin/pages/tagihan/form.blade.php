@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Form Tagihan</div>

                    <div class="card-body">
                        <form action="{{ @!$tagihan ? route('admin.tagihans.store') : route('admin.tagihans.update', $tagihan) }}" method="post">
                            @csrf
                            @isset($tagihan)
                                {{ method_field('PUT')}}
                            @endisset
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Jenis Tagihan</label>

                                <div class="col-md-6">
                                    <select class="form-select select2" name="jenis_tagihan_id">
                                        <option>- Pilih Jenis Tagihan -</option>
                                        @foreach($jenisTagihans as $option)
                                            <option value="{{ $option->id }}" {{ $option->id == old('jenis_tagihan_id', @$tagihan ? $tagihan->jenisTagihan->id : '') ? 'selected' : '' }}>{{ $option->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('jenis_tagihan_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Pedagang</label>

                                <div class="col-md-6">

                                    <select class="form-select select2" name="pedagang_id">
                                        <option>- Pilih Pedagang -</option>
                                        @foreach($pedagangs as $option)
                                            <option value="{{ $option->id }}" {{ $option->id == old('pedagang_id', @$tagihan ? $tagihan->pedagang->id : '') ? 'selected' : '' }}>{{ $option->nama }}</option>
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
                                <label class="col-md-4 col-form-label text-md-end">Nominal</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal', @$tagihan ? $tagihan->nominal : '') }}">

                                    @error('nominal')
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
