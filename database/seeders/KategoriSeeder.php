<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            "pedagang"      => 1,
            "tempat parkir" => 0,
            "toilet"        => 0,
        ];

        foreach ($names as $name => $isPedagang) {
            Kategori::query()->create([
                "nama_kategori" => $name,
                "is_pedagang"   => $isPedagang,
            ]);
        }
    }
}
