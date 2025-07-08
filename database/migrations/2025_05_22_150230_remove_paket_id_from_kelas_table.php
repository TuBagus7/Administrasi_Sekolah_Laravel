<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaketIdFromKelasTable extends Migration
{
    /**
     * Jalankan migrasi: hapus kolom paket_id dari tabel kelas.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Hapus foreign key constraint jika ada, lalu hapus kolomnya
            if (Schema::hasColumn('kelas', 'paket_id')) {
                $table->dropForeign(['paket_id']); // jika sebelumnya pakai foreign key
                $table->dropColumn('paket_id');
            }
        });
    }

    /**
     * Kembalikan perubahan (rollback): tambahkan kembali kolom paket_id ke tabel kelas.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            if (!Schema::hasColumn('kelas', 'paket_id')) {
                $table->unsignedBigInteger('paket_id')->nullable();

                // Uncomment jika sebelumnya ada foreign key ke tabel paket
                // $table->foreign('paket_id')->references('id')->on('paket')->onDelete('set null');
            }
        });
    }
}
