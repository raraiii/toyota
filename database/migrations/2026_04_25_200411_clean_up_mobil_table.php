<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('mobil', function (Blueprint $table) {
        // Hapus kolom 'foto' yang lama karena kita sudah pakai 'fotos' (JSON)
        if (Schema::hasColumn('mobil', 'foto')) {
            $table->dropColumn('foto');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
