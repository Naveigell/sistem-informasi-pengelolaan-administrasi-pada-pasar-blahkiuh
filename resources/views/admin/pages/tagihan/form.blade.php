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
                                        @foreach($pedagang->tempat->tempatKategori as $option)
                                            @php
                                                $randomId = uniqid();
                                            @endphp
                                            <div class="form-check form-check-inline form-group">
                                                <input data-nominal="{{ $option->nominal }}" class="form-check-input" name="tempat_kategori_ids-{{ $option->id }}" type="checkbox" id="{{ $randomId }}">
                                                <label class="form-check-label" for="{{ $randomId }}">{{ $option->nama_kategori }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">Nominal</label>

                                <div class="col-md-6">
                                    <input type="text" id="nominal-display-1" readonly class="form-control nominal @error('nominal') is-invalid @enderror" value="{{ number_format((int) old('nominal', @$tagihan ? $tagihan->nominal : ''), 0, ',', '.') }}">

                                    @error('nominal')
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

            $('input[type=checkbox]').prop('checked',false);

            $('#nominal-display-1').val('');

            $('.tagihans').hide();

            $(`#${id}`).show();
        });

        $('input:checkbox').change(function(){

            let nominal = Array.from(
                document.querySelectorAll('input[type=checkbox]:checked')
            ).reduce(function (total, item) {
                return total + parseInt(item.getAttribute('data-nominal'));
            }, 0);

            $('#nominal-display-1').val(nominal);
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
