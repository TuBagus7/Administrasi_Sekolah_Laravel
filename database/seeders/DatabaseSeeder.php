<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            HariSeeder::class,
            KehadiranSeeder::class,
            PaketSeeder::class,
            RuangSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
