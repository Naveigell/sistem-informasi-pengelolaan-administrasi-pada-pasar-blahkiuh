@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Informasi {{ $tempat->nama_tempat }}</div>

                    <div class="card-body">
                        @if(auth()->user()->level == 'Admin/Bendahara')
                            <div class="mb-4">
                                <a href="{{ route('admin.tempats.kategori.create', $tempat) }}" class="btn btn-primary">Tambah {{ $tempat->nama_tempat }} Kategori</a>
                            </div>
                        @endif
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $category->nama_kategori }}
                                        </td>
                                        <td>
                                            {{ $category->keterangan }}
                                        </td>
                                        <td>
                                            Rp. {{ $category->nominal_formatted }}
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.tempats.kategori.destroy', [$tempat, $category]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.tempats.kategori.edit', [$tempat, $category]) }}" class="btn btn-sm btn-warning"><i class="fa fa-cog"></i></a>
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
