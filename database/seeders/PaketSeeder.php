<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketSeeder extends Seeder
{
    public function run()
    {
        DB::table('paket')->insert([
            ['ket' => 'IPA'],
            ['ket' => 'IPS'],
        ]);
    }
}
