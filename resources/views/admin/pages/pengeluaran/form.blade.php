@extends('layouts.app')

@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12">
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
                                <input type="text" readonly class="form-control @error('tgl') is-invalid @enderror" name="tgl" value="{{ date('Y-m-d') }}">

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
                                <input type="text" id="nama-pengeluaran" class="form-control @error('nama_pengeluaran') is-invalid @enderror" name="nama_pengeluaran" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Jumlah</label>

                            <div class="col-md-6">
                                <input type="text" id="jumlah" min="1" class="nominal form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Nominal') }}</label>

                            <div class="col-md-6">
                                <input type="text" id="nominal" min="1" class="nominal form-control @error('nominal') is-invalid @enderror" name="nominal" value="">
                            </div>
                        </div>

                        <button type="button" class="btn btn-success" onclick="addPengeluaran()">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <form action="{{ route('admin.pengeluaran.store') }}" method="post">
                @csrf
                <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl">
                <div class="card">
                    <div class="card-header">Data Pengeluaran</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Pengeluaran</th>
                                    <th>Jumlah</th>
                                    <th>Nominal</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="pengeluaran-container">
                                @if(count($errors) > 0)

                                    @foreach(session()->getOldInput('nama_pengeluaran') as $pengeluaran)
                                        @php
                                            $bytes = random_bytes(8);
                                        @endphp
                                        <tr id="row-{{ $bytes }}">
                                            <td>
                                                <input type="text" name="nama_pengeluaran[]" class="form-control" readonly value="{{ $pengeluaran }}">
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah[]" class="form-control" readonly value="{{ session()->getOldInput('jumlah')[$loop->index] }}">
                                            </td>
                                            <td>
                                                <input type="number" name="nominal[]" class="form-control" readonly value="{{ session()->getOldInput('nominal')[$loop->index] }}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" readonly value="{{ session()->getOldInput('nominal')[$loop->index] * session()->getOldInput('jumlah')[$loop->index] }}">
                                            </td>
                                            <td>
                                                <button type="button" data-row-id="row-{{ $bytes }}" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif
                            </tbody>
                        </table>

                        <hr>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" cols="30" rows="10"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function addPengeluaran() {
            let id = (Math.random() + 1).toString(36) + Date.now();
            let namaPengeluaran = $('#nama-pengeluaran').val();
            let jumlah          = $('#jumlah').val().replaceAll(',', '');
            let nominal         = $('#nominal').val().replaceAll(',', '');

            let total = jumlah * nominal;

            $('#pengeluaran-container').append(`
                                   <tr id="row-${id}">
                                        <td>
                                            <input type="text" name="nama_pengeluaran[]" class="form-control" readonly value="${namaPengeluaran}">
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control" readonly value="${jumlah}">
                                        </td>
                                        <td>
                                            <input type="number" name="nominal[]" class="form-control" readonly value="${nominal}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" readonly value="${total}">
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
