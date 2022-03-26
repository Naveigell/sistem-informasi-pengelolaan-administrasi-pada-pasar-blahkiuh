@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Form Pengeluaran') }}</div>

                <div class="card-body">
                    <form action="{{ (!isset($pengeluaran->id)) ? route('admin.pengeluaran.store') : route('admin.pengeluaran.update', $pengeluaran->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($pengeluaran->id)
                            {{ method_field('PUT')}}
                        @endisset

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">No Invoice</label>

                            <div class="col-md-6">
                                <input type="text" readonly class="form-control" name="tgl" value="INVP-{{ $latestId ? $latestId + 1 : 1 }}-{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input type="text" readonly class="form-control datepicker @error('tgl') is-invalid @enderror" name="tgl" value="{{ date('Y-m-d') }}">

                                @error('tgl')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Nama Pengeluaran') }}</label>

                            <div class="col-md-6">
                                <input type="text" id="nama-pengeluaran" class="form-control @error('nama_pengeluaran') is-invalid @enderror" name="nama_pengeluaran" value="{{ old('nama_pengeluaran', $pengeluaran->nama_pengeluaran) }}">

                                @error('nama_pengeluaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Jumlah</label>

                            <div class="col-md-6">
                                <input type="number" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah', $pengeluaran->jumlah) }}">

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Nominal') }}</label>

                            <div class="col-md-6">
                                <input type="number" id="nominal" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal', $pengeluaran->nominal) }}">

                                @error('nominal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="button" class="btn btn-success" onclick="addPengeluaran()">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">Data Pengeluaran</div>

                <div class="card-body">
                    <form action="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Pengeluaran</th>
                                    <th>Jumlah</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="pengeluaran-container">
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function addPengeluaran() {
            let id = (Math.random() + 1).toString(36) + Date.now();
            let namaPengeluaran = $('#nama-pengeluaran').val();
            let jumlah          = $('#jumlah').val();
            let nominal         = $('#nominal').val();

            $('#pengeluaran-container').append(`
                                   <tr id="row-${id}">
                                        <td>
                                            <input type="text" name="nama_pengeluaran[]" class="form-control" readonly value="${namaPengeluaran}">
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control" readonly value="${jumlah}">
                                        </td>
                                        <td>
                                            <input type="number" name="biaya[]" class="form-control" readonly value="${nominal}">
                                        </td>
                                        <td>
                                            <button type="button" data-row-id="row-${id}" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`);

            addPengeluaranEvent();

            $('#nama-pengeluaran').val('');
            $('#jumlah').val('');
            $('#nominal').val('');
        }
    </script>
    <script>
        addPengeluaranEvent();

        function addPengeluaranEvent() {
            $(document).delegate('.btn-delete', 'click', function (evt) {
                try {
                    document.getElementById($(evt.currentTarget).data('row-id')).remove()
                } catch (e) {
                }
            });
        }
    </script>
@endpush
