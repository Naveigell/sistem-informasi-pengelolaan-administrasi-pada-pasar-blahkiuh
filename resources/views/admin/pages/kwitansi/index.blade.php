@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Kwitansi') }}</div>

                <div class="card-body">
                    @if(auth()->user()->level == 'Admin/Bendahara')
                        <div class="mb-4">
                            <a href="{{ route('admin.kwitansi.create') }}" class="btn btn-primary">Tambah Kwitansi</a>
                        </div>
                    @endif
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. Kwitansi</th>
                                <th>Pedagang</th>
                                <th>Tgl</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
{{--                                <th>Aksi</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kwitansi as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->no_kwitansi }}</td>
                                    <td>{{ $row->pedagang->nama }}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                    <td>{{ $row->keterangan }}</td>
{{--                                    <td>--}}
{{--                                        <form action="{{ route('admin.kwitansi.destroy', $row->id) }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            <a href="{{ route('admin.kwitansi.show', $row->id) }}" class="btn btn-sm btn-info text-white" title="cetak" target="_blank"><i class="fa fa-print"></i></a>--}}
{{--                                            @if(auth()->user()->level == 'Admin/Bendahara')--}}
{{--                                                <a href="{{ route('admin.kwitansi.edit', $row->id) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa fa-cog"></i></a>--}}
{{--                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin untuk menghapus data?')"><i class="fa fa-trash"></i></button>--}}
{{--                                            @endif--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
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
