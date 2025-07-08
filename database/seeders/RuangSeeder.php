<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 40; $i++) {
            $r = $i < 10 ? '0' . $i : $i;
            DB::table('ruang')->insert([
                'id' => $i,
                'nama_ruang' => 'Ruang ' . $r,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
