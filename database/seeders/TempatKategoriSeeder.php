<?php

namespace Database\Seeders;

use App\Models\Tempat;
use App\Models\TempatKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempatKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places     = Tempat::all();
        $keterangan = [
            'tahun'  => 'pembayaran sewa toko',
            'bulan'  => 'pembayaran listrik',
            'minggu' => 'pembayaran iuran',
        ];

        foreach ($places as $place) {
            foreach ($keterangan as $item => $kategori) {
                TempatKategori::query()->create([
                    "tempat_id"     => $place->id,
                    "nama_kategori" => $kategori,
                    "keterangan"    => $item,
                    "nominal"       => rand(5, 10) * (10 ** rand(4, 6)),
                ]);
            }
        }
    }
}
