@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pedagang') }}</div>

                <div class="card-body">
                    @if(auth()->user()->level == 'Admin/Bendahara')
                    <div class="mb-4">
                        <a href="{{ route('admin.pedagang.create') }}" class="btn btn-primary">Tambah Pedagang</a>
                    </div>
                    @endif
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tempat</th>
                                <th>No. Telp</th>
                                <th>Tgl. Bergabung</th>
                                <th>Jenis Dagangan</th>
                                @if(auth()->user()->level == 'Admin/Bendahara')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedagang as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->tempat->nama_tempat }}{{ $row->position ? ' - ' . $row->position : '' }}</td>
                                    <td>{{ $row->no_telp }}</td>
                                    <td>{{ $row->tgl_bergabung }}</td>
                                    <td>{{ $row->jenis_dagangan }}</td>
                                    @if(auth()->user()->level == 'Admin/Bendahara')
                                    <td>
                                        <form action="{{ route('admin.pedagang.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('admin.pedagang.edit', $row->id) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa fa-cog"></i></a>
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
