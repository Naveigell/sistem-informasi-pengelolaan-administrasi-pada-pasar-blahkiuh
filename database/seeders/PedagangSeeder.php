<?php

namespace Database\Seeders;

use App\Models\Pedagang;
use App\Models\Tempat;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Factory::create('id_ID');
        $places = Tempat::query()->pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            Pedagang::query()->create([
                "tempat_id"     => $places[array_rand($places)],
                "nama"          => $faker->name,
                "email"         => $faker->safeEmail,
                "password"      => 123456,
                "no_telp"       => $faker->numerify('08########'),
                "tgl_bergabung" => now()->addDays(rand(30, 50) - 20)->toDateString(),
            ]);
        }
    }
}
