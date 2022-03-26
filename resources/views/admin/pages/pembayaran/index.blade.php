@extends('layouts.app')

@section('content')
<style>
    td form {
        display: inline-block;
    }
</style>
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pembayaran') }}</div>

                <div class="card-body">
                    <div class="mb-4">
                        @if (auth()->guard('web')->check())
                            @if(auth()->user()->level == 'Admin/Bendahara')
                                <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
                            @endif
                        @else
                            <a href="{{ route('pedagang.pembayaran.create') }}" class="btn btn-primary">Tambah Pembayaran</a>
                        @endif
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori pembayaran</th>
                                <th>Pedagang</th>
                                <th>Tgl</th>
                                <th>Nominal</th>
                                @if(request()->query('type') === 'non-tunai')
                                    <th>Bukti Pembayaran</th>
                                @else
                                    <th>Cetak Kwitansi</th>
                                @endif
                                <th>Status</th>
                                <th>Keterangan</th>
                                @if (auth()->guard('web')->check())
                                    @if(auth()->user()->level == 'Admin/Bendahara')
                                        <th>Aksi</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->kategori?->nama_kategori ?? 'Tidak Ada' }}</td>
                                    <td>{{ $row->pedagang?->nama ?? 'Tidak Ada'}}</td>
                                    <td>{{ $row->tgl }}</td>
                                    <td>Rp. {{ number_format($row->nominal) }}</td>
                                    @if(request()->query('type') === 'non-tunai')
                                        <td><a href="{{ asset('storage/' . str_replace('public/', '', $row->bukti_pembayaran)) }}" target="_blank">Lihat bukti</a></td>
                                    @else
                                        <td>
                                            <a href="{{ $row->kwitansi ? route('admin.kwitansi.show', $row->kwitansi) : '' }}" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>
                                        </td>
                                    @endif
                                    <td>{{ $row->status }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    @if (auth()->guard('web')->check())
                                        @if(auth()->user()->level == 'Admin/Bendahara')
                                            <td>
                                                @if ($row->status == 'Pending')
                                                    <form action="{{ route('admin.pembayaran.update', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="1">
                                                        <input type="hidden" name="keterangan" value="sudah lunas">
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah anda yakin untuk meng-acc pembayaran?')"><i class="fa fa-check"></i></button>
                                                    </form>
                                                    <form action="{{ route('admin.pembayaran.update', $row->id) }}" method="post" id="decline-{{ $row->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="2">
                                                        <input type="hidden" name="keterangan" id="keterangan-{{ $row->id }}">
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="return declineInformation({{ $row->id }})"><i class="fa fa-times"></i></button>
                                                    </form>
                                                @else
                                                    -
                                                @endif
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

@push('scripts')
    <script>
        function declineInformation(id) {
            let information = prompt("Alasan menolak : ");

            if (!(information == null || information === "")) {
                $('#keterangan-' + id).val(information);
                $('#decline-' + id).submit();
            }
        }
    </script>
@endpush
