<?php

namespace Database\Seeders;

use App\Models\Pengeluaran;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker       = Factory::create();
        $pengeluaran = [];

        for ($i = 0; $i < 30; $i++) {
            $pengeluaran[] = [
                "nama_pengeluaran"  => $faker->text(20),
                "nominal"           => rand(1, 10) * (10 ** rand(1, 5)),
                "tgl"               => $faker->date,
                "keterangan"        => $faker->text(90),
                "bukti_pengeluaran" => $faker->text(10),
                "user_id"           => 1,
                "created_at"        => now()->toDateTimeString(),
                "updated_at"        => now()->toDateTimeString(),
            ];
        }

        Pengeluaran::query()->insert($pengeluaran);
    }
}
