<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            "nama"     => "admin",
            "email"    => "admin@gmail.com",
            "password" => 123456,
            "level"    => 1,
        ]);
    }
}
