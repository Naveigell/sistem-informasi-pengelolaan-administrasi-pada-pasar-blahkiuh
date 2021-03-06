@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Kategori') }}</div>

                    <div class="card-body">
                        @if(auth()->user()->level == 'Admin/Bendahara')
                            <div class="mb-4">
                                <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
                            </div>
                        @endif
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Pedagang</th>
                                <th>Otomatis</th>
                                @if(auth()->user()->level == 'Admin/Bendahara')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($kategori as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($row->nama_kategori) }}</td>
                                    <td>{{ $row->is_pedagang ? 'Iya' : '-'  }}</td>
                                    <td>{{ $row->is_automatic ? 'Iya' : '-'  }}</td>
                                    @if(auth()->user()->level == 'Admin/Bendahara')
                                        <td>
                                            <form action="{{ route('admin.kategori.destroy', $row) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.kategori.edit', $row) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa fa-cog"></i></a>
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
