<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaketIdFromMapelTable extends Migration
{
    public function up()
    {
        Schema::table('mapel', function (Blueprint $table) {
            // JANGAN dropForeign, langsung drop kolom aja
            if (Schema::hasColumn('mapel', 'paket_id')) {
                $table->dropColumn('paket_id');
            }
        });
    }

    public function down()
    {
        Schema::table('mapel', function (Blueprint $table) {
            if (!Schema::hasColumn('mapel', 'paket_id')) {
                $table->unsignedBigInteger('paket_id')->nullable();
            }
        });
    }
}
