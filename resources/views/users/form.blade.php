@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Form User') }}</div>
                    <div class="card-body">
                        <form action="{{ (!isset($user->id)) ? route('users.store') : route('users.update', $user->id) }}" method="post">
                            @csrf
                            @isset($user->id)
                                {{ method_field('PUT')}}
                            @endisset

                            <div class="row mb-3">
                                <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $user->nama) }}" required autocomplete="name" autofocus>

                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Level') }}</label>
                                <div class="col-md-6">
                                   <select name="level" class="form-select">
                                        <option value="">- Pilih Level -</option>
                                        <option value="1" {{ old('level', $user->level) == "Admin/Bendahara" ? 'selected' : '' }}>Admin/Bendahara</option>
                                        <option value="2" {{ old('level', $user->level) == "Kepala Pasar" ? 'selected' : '' }}>Kepala Pasar</option>
                                    </select>
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