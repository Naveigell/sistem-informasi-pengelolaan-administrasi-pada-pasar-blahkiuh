@extends('layouts.app')

@section('content')
<style>
    td form {
        display: inline-block;
    }
</style>
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pembayaran') }}</div>

                <div class="card-body">
                    <div class="mb-4">
                        @if (auth()->guard('web')->check())
                            @if(auth()->user()->level == 'Admin/Bendahara')
                                <a href="{{ route('pembayaran.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
                            @endif
                        @else
                            <a href="{{ route('pedagang.pembayaran.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
                        @endif
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori pembayaran</th>
                                <th>Pedagang</th>
                                <th>Tgl</th>
                                <th>Nominal</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                @if (auth()->guard('web')->check())
                                    @if(auth()->user()->level == 'Admin/Bendahara')
                                        <th>Aksi</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kategori?->nama_kategori ?? 'Tidak Ada' }}</td>
                                    <td>{{ $row->pedagang?->nama ?? 'Tidak Ada'}}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                    <td><a href="{{ asset('storage/' . str_replace(['public/'] , [''], $row->bukti_pembayaran)) }}" target="_blank">Lihat bukti</a></td>
                                    <td>{{ $row->status }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    @if (auth()->guard('web')->check())
                                        @if(auth()->user()->level == 'Admin/Bendahara')
                                            <td>
                                                @if ($row->status == 'Pending')
                                                    <form action="{{ route('pembayaran.update', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="1">
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah anda yakin untuk meng-acc pembayaran?')"><i class="fa fa-check"></i></button>
                                                    </form>
                                                    <form action="{{ route('pembayaran.update', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="2">
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menolak pembayaran?')"><i class="fa fa-times"></i></button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('pembayaran.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin untuk menghapus data?')"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        @endif
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
