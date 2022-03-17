@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pengeluaran') }}</div>

                <div class="card-body">
                    @if(auth()->user()->level == 'Admin/Bendahara')
                        <div class="mb-4">
                            <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary">Tambah Pengeluaran</a>
                        </div>
                    @endif
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengeluaran</th>
                                <th>Tgl</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Bukti Pengeluaran</th>
                                <th>User</th>
                                @if(auth()->user()->level == 'Admin/Bendahara')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_pengeluaran }}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td><a href="{{ asset('storage/' . $row->bukti_pengeluaran) }}" target="_blank">Lihat bukti</a></td>
                                    <td>{{ $row->user->nama }}</td>
                                    @if(auth()->user()->level == 'Admin/Bendahara')
                                        <td>
                                            <form action="{{ route('pengeluaran.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('pengeluaran.edit', $row->id) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa fa-cog"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin untuk menghapus data?')"><i class="fa fa-trash"></i></button>
                                            </form>
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
