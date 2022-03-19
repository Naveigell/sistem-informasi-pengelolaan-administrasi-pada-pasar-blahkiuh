@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengeluaran') }}</div>

                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pedagang</th>
                                <th>Keterangan</th>
                                <th>Tgl</th>
                                <th>Nominal</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluaran as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->pedagang->nama ?? 'Tidak Ada'}}</td>
                                        <td>{{ $row->keterangan }}</td>
                                        <td>{{ $row->tgl }}</td>
                                        <td>Rp. {{ number_format($row->nominal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
