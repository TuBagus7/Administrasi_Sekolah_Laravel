<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KehadiranSeeder extends Seeder
{
    public function run()
    {
        // Opsional: bersihkan dulu data
        DB::table('kehadiran')->truncate();

        DB::table('kehadiran')->insert([
            [
                'id' => 1,
                'ket' => 'Hadir',
                'color' => '3C0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'ket' => 'Sakit',
                'color' => 'F00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'ket' => 'Izin',
                'color' => '00F',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'ket' => 'Alfa',
                'color' => '000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
