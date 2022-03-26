@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Laporan Pemasukan') }}</div>

                <div class="card-body">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="get" class="row">
                                    <div class="form-group col-6">
                                        <label for="">Jenis Pemasukan</label>
                                        <select name="kategori" id="" class="form-select select2">
                                            <option value="">Pilih</option>
                                            @foreach($categories as $id => $categoryName)
                                                <option {{ request('kategori') == $id ? 'selected' : '' }} value="{{ $id }}">{{ $categoryName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Jenis Cukai</label>
                                        <select name="jenis_cukai" class="form-select select2" id="jenis_cukai">
                                            <option value="">Pilih</option>
                                            <option value="harian" {{ request('jenis_cukai') == 'harian' ? 'selected' : '' }}>Harian</option>
                                            <option value="bulanan" {{ request('jenis_cukai') == 'bulanan' ? 'selected' : ''  }}>Bulanan</option>
                                            <option value="tahunan" {{ request('jenis_cukai') == 'tahunan' ? 'selected' : ''  }}>Tahunan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 mt-3 {{ request('jenis_cukai') == 'harian' ? '' : 'd-none' }}" id="field-harian">
                                        <label>Tanggal</label>
                                        <input type="text" name="tgl" class="form-control datepicker" id="tgl-tgl" value="{{ request('tgl') }}">
                                    </div>
                                    <div class="row col-12 {{ request('jenis_cukai') == 'bulanan' ? '' : 'd-none' }}" id="field-bulanan">
                                        <div class="col-6">
                                            <div class="form-group mt-3">
                                                <label>Bulan</label>
                                                <select name="bulan" class="form-select select2" id="bulan-bulan">
                                                    @foreach (bulan() as $key => $option)
                                                        <option value="{{ $key }}" {{ $key == request('bulan') ? 'selected' : '' }}>{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mt-3">
                                                <label>Tahun</label>
                                                <input type="text" name="tahun" class="form-control" id="tahun-bulan" value="{{ request('tgl') ?? date('Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mt-3 {{ request('jenis_cukai') == 'tahunan' ? '' : 'd-none' }}" id="field-tahunan">
                                        <label>Tahun</label>
                                        <input type="number" name="tahun" class="form-control" id="tahun-tahun" value="{{ request('tahun', date('Y')) }}">
                                    </div>
                                    <div class="form-group col-12 mt-3">
                                        <input type="submit" value="Cari" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (request()->get('jenis_cukai'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            Cukai {{ request()->get('jenis_cukai') }}
                        </div>
                        @if($pemasukan->count() > 0)
                            <div>
                                <a href="{{ route('admin.pemasukan.cetak') .'?'. getParams(url()->full()) }}" target="_blank">Cetak</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if (request('jenis_cukai') == 'bulanan')
                    {{ bulan()[request('bulan')] . ' ' . request('tahun') }}
                    @else
                    <p>Tanggal: {{ request('tgl') }}</p>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                {!! request('jenis_cukai') == 'bulanan' ? '<th>Tgl</th>' : '' !!}
                                <th>Kategori Pemasukan</th>
                                <th>Pedagang</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total = 0;
                            ?>
                            @foreach ($pemasukan as $row)
                                <?php $total += $row->nominal ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {!! request('jenis_cukai') == 'bulanan' ? '<th>'.$row->tgl.'</th>' : '' !!}
                                    <td>{{ ucwords($row->kategori?->nama_kategori ?? 'Tidak Ada') }}</td>
                                    <td>{{ $row->pedagang?->nama ?? '-'}}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                {!! request('jenis_cukai') == 'bulanan' ? '<td></td>' : '' !!}
                                <td>Total</td>
                                <td>Rp. {{ number_format($total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
    <script>
        $('#jenis_cukai').change(function(){
            $('#field-harian').addClass('d-none');
            $('#field-bulanan').addClass('d-none');
            $('#field-tahunan').addClass('d-none');

            if ($(this).val() === 'harian') {
                $('#field-harian').removeClass('d-none');
                $('#field-bulanan').addClass('d-none');
                $('#field-tahunan').addClass('d-none');

                $('#tgl').attr('name', 'tgl');
                $('#bulan-bulan').removeAttr('name');
                $('#tahun-bulan').removeAttr('name');
                $('#tahun-tahun').removeAttr('name');
            }

            if ($(this).val() === 'bulanan') {
                $('#field-tahunan').addClass('d-none');
                $('#field-bulanan').removeClass('d-none');
                $('#field-harian').addClass('d-none');

                $('#bulan-bulan').attr('name', 'bulan');
                $('#tahun-bulan').attr('name', 'tahun');
                $('#tahun-tahun').removeAttr('name');
                $('#tgl-tgl').removeAttr('name');
            }

            if ($(this).val() === 'tahunan') {
                $('#field-tahunan').removeClass('d-none');
                $('#field-bulanan').addClass('d-none');
                $('#field-harian').addClass('d-none');

                $('#tgl-tgl').removeAttr('name');
                $('#bulan-bulan').removeAttr('name');
                $('#tahun-bulan').removeAttr('name');
                $('#tahun-tahun').attr('name', 'tahun');
            }

        });
    </script>
@endpush
