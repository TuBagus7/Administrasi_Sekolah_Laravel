<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('nis'); // Menggunakan NIS sebagai kunci
            $table->date('tanggal');
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Alfa']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key ke tabel siswas kolom nis
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
