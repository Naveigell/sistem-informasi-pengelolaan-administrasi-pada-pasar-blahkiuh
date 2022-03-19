@extends('layouts.app')

@section('content')
    <style>
        textarea {
            height: 200px;
        }
    </style>
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Form Pemasukan') }} dari {{ ucwords($kategori->nama_kategori) }}</div>

                    <div class="card-body">
                        <form action="{{ @!$pemasukan ? route('kategori.pemasukan.store', $kategori) : route('kategori.pemasukan.update', [$kategori, $pemasukan]) }}" method="post">
                            @csrf
                            @isset($pemasukan->id)
                                {{ method_field('PUT')}}
                            @endisset

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Kategori</label>

                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control" value="{{ ucwords($kategori->nama_kategori) }}">
                                    <input type="text" hidden name="kategori_id" readonly class="form-control" value="{{ $kategori->id }}">
                                </div>
                            </div>

                            @if($kategori->is_pedagang)

                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-end">Pedagang</label>

                                    <div class="col-md-6">

                                        <select class="form-select select2" name="pedagang_id" id="pedagang-dropdown">
                                            <option value="">- Pilih Pedagang -</option>
                                            @foreach($pedagangs as $option)
                                                <option data-position="{{ $option->position }}" data-nama-tempat="{{ $option->tempat->nama_tempat }}" data-pemasukan-id="pemasukan-{{ $option->id }}" value="{{ $option->id }}" {{ $option->id == old('pedagang_id', @$pemasukan ? $pemasukan->pedagang_id : '') ? 'selected' : '' }}>{{ $option->nama }}</option>
                                            @endforeach
                                        </select>

                                        @error('pedagang_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                @foreach($pedagangs as $pedagang)
                                    <div class="row mb-3 pemasukans pemasukan-{{ $pedagang->id }}" id="pemasukan-{{ $pedagang->id }}">
                                        <label class="col-md-4 col-form-label text-md-end">Jenis Pemasukan</label>

                                        <div class="col-md-6">
                                            <select class="form-select select2">
                                                <option value="">- Pilih Jenis Pemasukan -</option>
                                                @foreach($pedagang->tempat->tempatKategori as $option)
                                                    <option data-nominal="{{ $option->nominal }}" data-nominal-display="Rp. {{ $option->nominal_formatted }}" value="{{ $option->id }}" {{ $option->id == old('tempat_kategori_id', (@$tagihan) ? (($tagihan->pedagang_id === $pedagang->id) ? $tagihan->tempat_kategori_id : '') : '') ? 'selected' : '' }}>{{ $option->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Keterangan</label>

                                <div class="col-md-6">
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="" cols="10" rows="10">{{ old('keterangan', @$pemasukan ? $pemasukan->keterangan : '') }}</textarea>

                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control datepicker @error('tgl') is-invalid @enderror" name="tgl" value="{{ old('tgl', @$pemasukan ? $pemasukan->tgl : '') }}">

                                    @error('tgl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Nominal</label>

                                <div class="col-md-6">
                                    <input type="text" @if ($kategori->is_pedagang) readonly  @endif id="nominal" name="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal', @$pemasukan ? $pemasukan->nominal : '') }}">

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

@push('scripts')
    <script>
        $('.pemasukans').hide();

        $('#pedagang-dropdown').on('change', function () {
            let id = $(this).find(':selected').data('pemasukan-id');

            if ($(this).find(':selected').val()) {
                $('#nama-tempat').val($(this).find(':selected').data('nama-tempat') + ' - ' + $(this).find(':selected').data('position'));
            } else {
                $('#nama-tempat').val('');
            }

            $('#nominal-display').val('');

            $('.pemasukans').hide();

            $(`#${id}`).show();
        });

        $('.pemasukans').on('change', function () {
            $('#nominal-display').val($(this).find(':selected').data('nominal-display'));
            $('#nominal').val($(this).find(':selected').data('nominal'));

            $('#tempat_kategori_id').val($(this).find(':selected').val());
        })
    </script>

    @if(@$pemasukan)
        <script>
            $('.pemasukan-{{ $pemasukan->pedagang_id }}').show();
        </script>
    @endif
@endpush
