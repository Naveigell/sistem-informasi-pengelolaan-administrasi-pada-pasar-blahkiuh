@extends('layouts.app')

@section('content')
    <div class="">
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
                                <label class="col-md-4 col-form-label text-md-end">Pedagang</label>

                                <div class="col-md-6">

                                    <select class="form-select select2" name="pedagang_id" id="pedagang-dropdown">
                                        <option value="">- Pilih Pedagang -</option>
                                        @foreach($pedagangs as $option)
                                            <option data-position="{{ $option->position }}" data-nama-tempat="{{ $option->tempat->nama_tempat }}" data-tagihan-id="tagihan-{{ $option->id }}" value="{{ $option->id }}" {{ $option->id == old('pedagang_id', @$tagihan ? $tagihan->pedagang->id : '') ? 'selected' : '' }}>{{ $option->nama }}</option>
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
                                <label class="col-md-4 col-form-label text-md-end">Nama Tempat</label>

                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control" value="" disabled id="nama-tempat">
                                </div>
                            </div>

                            @foreach($pedagangs as $pedagang)
                                <div class="row mb-3 tagihans tagihan-{{ $pedagang->id }}" id="tagihan-{{ $pedagang->id }}">
                                    <label class="col-md-4 col-form-label text-md-end">Jenis Tagihan</label>

                                    <div class="col-md-6">
                                        <select class="form-select select2">
                                            <option value="">- Pilih Jenis Tagihan -</option>
                                            @foreach($pedagang->tempat->tempatKategori as $option)
                                                <option data-nominal="{{ $option->nominal }}" data-nominal-display="Rp. {{ $option->nominal_formatted }}" value="{{ $option->id }}" {{ $option->id == old('tempat_kategori_id', (@$tagihan) ? (($tagihan->pedagang_id === $pedagang->id) ? $tagihan->tempat_kategori_id : '') : '') ? 'selected' : '' }}>{{ $option->nama_kategori }}</option>
                                            @endforeach
                                        </select>

                                        @error('jenis_tagihan_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                            <input type="text" readonly name="tempat_kategori_id" id="tempat_kategori_id" hidden>
                            <input type="text" readonly name="nominal" id="nominal" hidden>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Nominal</label>

                                <div class="col-md-6">
                                    <input type="text" id="nominal-display" readonly class="form-control @error('nominal') is-invalid @enderror" value="Rp. {{ number_format((int) old('nominal', @$tagihan ? $tagihan->nominal : ''), 0, ',', '.') }}">

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
        $('.tagihans').hide();

        $('#pedagang-dropdown').on('change', function () {
            let id = $(this).find(':selected').data('tagihan-id');

            if ($(this).find(':selected').val()) {
                $('#nama-tempat').val($(this).find(':selected').data('nama-tempat') + ' - ' + $(this).find(':selected').data('position'));
            } else {
                $('#nama-tempat').val('');
            }

            $('#nominal-display').val('');

            $('.tagihans').hide();

            $(`#${id}`).show();
        });

        $('.tagihans').on('change', function () {
            $('#nominal-display').val($(this).find(':selected').data('nominal-display'));
            $('#nominal').val($(this).find(':selected').data('nominal'));

            $('#tempat_kategori_id').val($(this).find(':selected').val());
        })
    </script>

    @if(@$tagihan)
        <script>
            $('.tagihan-{{ $tagihan->pedagang->id }}').show();
        </script>
    @endif
@endpush
