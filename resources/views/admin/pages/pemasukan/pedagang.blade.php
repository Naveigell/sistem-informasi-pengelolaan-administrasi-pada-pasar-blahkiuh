@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pemasukan Pedagang</div>

                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pemasukan Pedagang</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kategori as $item)
                                <tr>
                                    <td class="col-1">{{ $loop->iteration }}</td>
                                    <td class="col-9">{{ $item->nama_kategori }}</td>
                                    <td>
                                        <a href="{{ route('admin.kategori.pemasukan.index', $item) }}" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>
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
