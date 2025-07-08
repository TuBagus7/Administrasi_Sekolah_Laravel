<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Memeriksa apakah kolom 'paket_id' ada sebelum mencoba mengubahnya
        if (Schema::hasColumn('kelas', 'paket_id')) {
            Schema::table('kelas', function (Blueprint $table) {
                // Pastikan tipe data (unsignedBigInteger) sesuai dengan yang sudah ada
                $table->unsignedBigInteger('paket_id')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Metode down() ini akan dijalankan saat Anda melakukan rollback migrasi.
        // Jika Anda ingin mengembalikan kolom ke NOT NULL, Anda harus memastikan
        // tidak ada nilai NULL di kolom 'paket_id' sebelum rollback,
        // atau Anda akan mendapatkan error.
        // Untuk keamanan, jika Anda tidak berencana untuk rollback atau jika rollbacknya kompleks,
        // Anda bisa mengosongkan bagian ini atau menambahkan logika untuk mengisi default.
        if (Schema::hasColumn('kelas', 'paket_id')) {
            Schema::table('kelas', function (Blueprint $table) {
                // Mengembalikan ke NOT NULL. Ini bisa menyebabkan error jika ada nilai NULL.
                $table->unsignedBigInteger('paket_id')->change();
            });
        }
    }
};