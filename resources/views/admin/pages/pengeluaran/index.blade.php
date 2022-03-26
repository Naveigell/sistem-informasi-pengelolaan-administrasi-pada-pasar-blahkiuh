@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Group Pengeluaran</div>

                <div class="card-body">
                    @if(auth()->user()->level == 'Admin/Bendahara')
                        <div class="mb-4">
                            <a href="{{ route('admin.pengeluaran.create') }}" class="btn btn-primary">Tambah Pengeluaran</a>
                        </div>
                    @endif
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Invoice</th>
                                <th>Tgl</th>
                                <th>Sub Total</th>
                                @if(auth()->user()->level == 'Admin/Bendahara')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->no_invoice }}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>Rp. {{ number_format($row->sub_total) }}</td>
                                    @if(auth()->user()->level == 'Admin/Bendahara')
                                        <td>
                                            <a href="{{ route('admin.pengeluaran.show', $row) }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i></a>
                                        </td>
                                    @endif
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
