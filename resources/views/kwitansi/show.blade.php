<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kwitansi</title>
    <style>
        .border {
            border: 3px solid black;
            height: 98%;
        }
        .text-center {
            text-align: center;
        }
        table tr td {
            padding:5px;
        }
    </style>
</head>
<body>
    <div class="border">
        <div class="text-center">
            <h1>Kwitansi</h1>
            <b>No. {{ $kwitansi->no_kwitansi }}</b>
        </div>
        <hr>
        <div style="width: 90%; margin:auto; font-size:19px">
            <table>
                <tr>
                    <td>Sudah diterima dari</td>
                    <td>:</td>
                    <td>{{ $kwitansi->pedagang->nama }}</td>
                </tr>
                <tr>
                    <td>Uang sebesar</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($kwitansi->nominal) }}</td>
                </tr>
                <tr>
                    <td>Terbilang</td>
                    <td>:</td>
                    <td>{{ $kwitansi->terbilang }}</td>
                </tr>
                <tr>
                    <td>Untuk pembayaran</td>
                    <td>:</td>
                    <td>{{ $kwitansi->keterangan }}</td>
                </tr>
            </table>
            <div style="padding-left: 5px; margin-top:15px; text-align:right">
                <p>Badung, {{ $kwitansi->tgl }}</p>
                <br>
                <br>
                <p>{{ env('APP_NAME') }}</p>
            </div>
        </div>
    </div>
</body>
</html>