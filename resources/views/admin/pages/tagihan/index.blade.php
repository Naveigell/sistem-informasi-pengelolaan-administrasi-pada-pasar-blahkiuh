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
                                <a href="{{ route('admin.tagihans.create') }}" class="btn btn-primary">Tambah Tagihan</a>
                            </div>
                        @endif
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>No Tagihan</th>
                                <th>Jenis Tagihan</th>
                                <th>Pedagang</th>
                                <th>Nominal</th>
                                <th>Lunas</th>
{{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($tagihans as $tagihan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tagihan->no_tagihan }}</td>
                                        <td>{{ $tagihan->tempatKategori->nama_kategori }}</td>
                                        <td>{{ $tagihan->pedagang->nama }}</td>
                                        <td>Rp. {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                        <td>
                                            @if($tagihan->is_lunas)
                                                <span class="badge badge-success"></span>
                                            @else
                                                <span class="badge badge-danger"></span>
                                            @endif
                                        </td>
{{--                                        <td>--}}
{{--                                            <form action="{{ route('admin.tagihans.destroy', $tagihan) }}" method="post">--}}
{{--                                                @csrf--}}
{{--                                                @method('delete')--}}
{{--                                                <a href="{{ route('admin.tagihans.edit', $tagihan) }}" class="btn btn-sm btn-warning"><i class="fa fa-cog"></i></a>--}}
{{--                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin untuk menghapus data?')"><i class="fa fa-trash"></i></button>--}}
{{--                                            </form>--}}
{{--                                        </td>--}}
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
