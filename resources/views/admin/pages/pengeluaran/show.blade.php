@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $pengeluaran->no_invoice }}</div>

                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengeluaran</th>
                                <th>Tgl</th>
                                <th>Jumlah</th>
                                <th>Nominal</th>
                                <th>User</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pengeluaran->pengeluaran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_pengeluaran }}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                    <td>{{ $row->user->nama }}</td>
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
