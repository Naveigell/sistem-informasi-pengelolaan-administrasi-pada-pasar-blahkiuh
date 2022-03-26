@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tagihan</div>

                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>No Tagihan</th>
                                <th>Jenis Tagihan</th>
                                <th>Pedagang</th>
                                <th>Nominal</th>
                                <th>Action</th>
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
                                        <button class="btn btn-sm btn-success btn-tunai">Tunai</button>
                                        <button class="btn btn-sm btn-warning btn-nontunai">Non Tunai</button>
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

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.btn-tunai').on('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: 'Silahkan melakukan pembayaran di  kantor administrasi pasar tradisional blahkiuh!',
            })
        });
        $('.btn-nontunai').on('click', function () {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                html: 'No rek : 0090102000111 <br> A/N : PASAR TRADISIONAL BLAHKIUH',
            })
        });
    </script>
@endpush
