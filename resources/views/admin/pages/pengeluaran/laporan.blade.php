@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Laporan Pengeluaran') }}</div>

                <div class="card-body">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="get">
                                    <div class="form-group">
                                        <label>Jenis Laporan</label>
                                        <select name="jenis_laporan" class="form-select select2" id="jenis_cukai">
                                            <option value="">Pilih</option>
                                            <option value="harian" {{ request('jenis_laporan') == 'harian' ? 'selected' : '' }}>Harian</option>
                                            <option value="bulanan" {{ request('jenis_laporan') == 'bulanan' ? 'selected' : ''  }}>Bulanan</option>
                                            <option value="tahunan" {{ request('jenis_laporan') == 'tahunan' ? 'selected' : ''  }}>Tahunan</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-3 {{ request('jenis_laporan') == 'harian' ? '' : 'd-none' }}" id="field-harian">
                                        <label>Tanggal</label>
                                        <input type="text" name="tgl" class="form-control datepicker" id="tgl-tgl" value="{{ request('tgl') }}">
                                    </div>
                                    <div class="row  {{ request('jenis_laporan') == 'bulanan' ? '' : 'd-none' }}" id="field-bulanan">
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
                                                <input type="number" name="tahun" class="form-control" id="tahun-bulan" value="{{ request('tahun') ?? date('Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 {{ request('jenis_laporan') == 'tahunan' ? '' : 'd-none' }}" id="field-tahunan">
                                        <label>Tahun</label>
                                        <input type="number" name="tahun" class="form-control" id="tahun-tahun" value="{{ request('tahun', date('Y')) }}">
                                    </div>
                                    <div class="form-group mt-3">
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

    @if (request()->filled('jenis_laporan'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            Laporan Pengeluaran
                        </div>
                        @if($pengeluaran->count() > 0)
                            <div>
                                <a href="{{ route('admin.pengeluaran.cetak') .'?'. getParams(url()->full()) }}" target="_blank">Cetak</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tgl</th>
                                <th>Nama Pengeluaran</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($pengeluaran as $row)
                            <?php $total += $row->nominal; ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>{{ $row->nama_pengeluaran }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Total</th>
                                <th>Rp. {{ number_format($total) }}</th>
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
