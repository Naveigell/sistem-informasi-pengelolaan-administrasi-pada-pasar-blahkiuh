@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengeluaran') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <form action="" class="p-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="from">Dari : </label>
                                            <input id="from" name="from" type="text" class="datepicker form-control" value="{{ request()->query('from') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="to">Sampai : </label>
                                            <input id="to" name="to" type="text" class="datepicker form-control" value="{{ request()->query('to') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-info">Filter</button>
                                            <a href="{{ route('pedagang.pengeluaran.index') }}" class="btn btn-sm btn-outline-info">Clear</a>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table class="table datatable mt-4">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pedagang</th>
                                <th>Keterangan</th>
                                <th>Tgl</th>
                                <th>Nominal</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluaran as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->pedagang->nama ?? 'Tidak Ada'}}</td>
                                        <td>{{ $row->keterangan }}</td>
                                        <td>{{ $row->tgl }}</td>
                                        <td>Rp. {{ number_format($row->nominal) }}</td>
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
