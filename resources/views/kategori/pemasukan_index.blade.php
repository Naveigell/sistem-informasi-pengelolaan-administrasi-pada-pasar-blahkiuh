@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pemasukan') }}</div>

                    <div class="card-body">
                        @if (auth()->guard('web')->check())
                            @if(auth()->user()->level == 'Admin/Bendahara')
                                <div class="mb-4">
                                    <a href="{{ route('pemasukan.create') }}" class="btn btn-primary">Tambah Pemasukan {{ ucwords($kategori->nama_kategori) }}</a>
                                </div>
                            @endif
                        @endif
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori Pemasukan</th>
                                <th>Pedagang</th>
                                <th>Keterangan</th>
                                <th>Tgl</th>
                                <th>Nominal</th>
                                @if (auth()->guard('web')->check())
                                    <th>User</th>
                                    @if(auth()->user()->level == 'Admin/Bendahara')
                                        <th>Aksi</th>
                                    @endif
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($kategori->pemasukan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kategori?->nama_kategori ?? 'Tidak Ada' }}</td>
                                    <td>{{ $row->pedagang?->nama ?? 'Tidak Ada'}}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                    @if (auth()->guard('web')->check())
                                        <td>{{ $row->user->nama }}</td>
                                        @if(auth()->user()->level == 'Admin/Bendahara')
                                            <td>
                                                <form action="{{ route('pemasukan.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('pemasukan.edit', $row->id) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa fa-cog"></i></a>
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
