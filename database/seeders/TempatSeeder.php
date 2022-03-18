<?php

namespace Database\Seeders;

use App\Models\Tempat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tempat::query()->insert([
            [
                "nama_tempat" => "Kios",
                "created_at"  => now()->toDateTimeString(),
                "updated_at"  => now()->toDateTimeString(),
            ],
            [
                "nama_tempat" => "Blok",
                "created_at"  => now()->toDateTimeString(),
                "updated_at"  => now()->toDateTimeString(),
            ],
        ]);
    }
}
