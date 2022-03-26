<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pemasukan</title>
    <style>
        .border {
            border: 3px solid black;
            height: 98%;
        }
        .text-center {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table tr td, table th {
            padding:5px;
            border: 1px solid black;
        }
        h2 {
            margin-bottom: 5px;
        }
        p {
            margin-bottom: 5px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="">
        <div class="">
            <div class="text-center header">
                <div style="margin-bottom:10px">
                    <img src="{{ public_path('img/logo.png') }}" alt="logo" width="80">
                </div>
                <h2>Pasar Tradisional Blahkiuh</h2>
                <p>Alamat: Jl. Ciung Wanara Blahkiuh, Abinsemal, Badung</p>
                <p>Tlp : 088219162457</p>
            </div>
            <hr>
            <h3>Laporan Pemasukan</h3>
            <p>Cukai {{ request()->get('jenis_cukai') }}</p>
            @if (request('jenis_cukai') == 'bulanan')
                <p>{{ bulan()[request('bulan')] . ' ' . request('tahun') }}</p>
            @else
                <p>Tanggal: {{ request('tgl') }}</p>
            @endif
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    {!! request('jenis_cukai') == 'bulanan' ? '<th>Tgl</th>' : '' !!}
                    <th>Kategori Pemasukan</th>
                    <th>Pedagang</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                ?>
                @foreach ($pemasukan as $row)
                    <?php $total += $row->nominal ?>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {!! request('jenis_cukai') == 'bulanan' ? '<td>'.$row->tgl.'</td>' : '' !!}
                        <td>{{ $row->kategori?->nama_kategori ?? 'Tidak Ada' }}</td>
                        <td>{{ $row->pedagang?->nama ?? 'Tidak Ada'}}</td>
                        <td>{{ $row->keterangan }}</td>
                        <td>Rp. {{ number_format($row->nominal) }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    {!! request('jenis_cukai') == 'bulanan' ? '<td></td>' : '' !!}
                    <td>Total</td>
                    <td>Rp. {{ number_format($total) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
