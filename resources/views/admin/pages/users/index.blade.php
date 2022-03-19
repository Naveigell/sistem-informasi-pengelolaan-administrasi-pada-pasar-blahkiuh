@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <div class="mb-4">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->level }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('admin.users.edit', $row->id) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa fa-cog"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin untuk menghapus data?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
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
