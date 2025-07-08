<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPaketIdFromKelasTable extends Migration
{
    public function up()
{
    Schema::table('kelas', function (Blueprint $table) {
        if (Schema::hasColumn('kelas', 'paket_id')) {
            $table->dropColumn('paket_id');
        }
    });
}


    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->integer('paket_id')->nullable(); // atau sesuai tipe awalnya
        });
    }
}
