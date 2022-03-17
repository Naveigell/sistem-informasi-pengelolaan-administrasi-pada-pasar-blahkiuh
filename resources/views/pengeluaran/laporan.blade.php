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
                                    <div class="row" id="field-bulanan">
                                        <div class="col-6">
                                            <div class="form-group mt-3">
                                                <label>Bulan</label>
                                                <select name="bulan" class="form-select" id="bulan">
                                                    @foreach (bulan() as $key => $option)
                                                        <option value="{{ $key }}" {{ $key == request('bulan') ? 'selected' : '' }}>{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mt-3">
                                                <label>Tahun</label>
                                                <input type="text" name="tahun" class="form-control" id="tahun" value="{{ request('tgl') ?? date('Y') }}">
                                            </div>
                                        </div>
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

    @if (request()->get('bulan'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            Laporan Pengeluaran
                        </div>
                        <div>
                            <a href="{{ route('pengeluaran.cetak') .'?'. getParams(url()->full()) }}" target="_blank">Cetak</a>
                        </div>
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
