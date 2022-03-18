@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tagihan</div>

                    <div class="card-body">
                        @if(auth()->user()->level == 'Admin/Bendahara')
                            <div class="mb-4">
                                <a href="{{ route('admin.tempats.create') }}" class="btn btn-primary">Tambah Tempat</a>
                            </div>
                        @endif
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Tempat</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($tempats as $tempat)
                                    <tr>
                                        <td class="col-1">{{ $loop->iteration }}</td>
                                        <td class="col-9">{{ $tempat->nama_tempat }}</td>
                                        <td class="col-2">
                                            <form action="{{ route('admin.tempats.destroy', $tempat) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.tempats.edit', $tempat) }}" class="btn btn-sm btn-warning"><i class="fa fa-cog"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin untuk menghapus data?')"><i class="fa fa-trash"></i></button>
                                                <a href="{{ route('admin.tempats.kategori.index', $tempat) }}" class="btn btn-sm btn-info"><i class="fa fa-info"></i></a>
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
