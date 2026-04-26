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
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke Sales
        $table->json('fotos')->nullable(); // Untuk menampung banyak foto
        $table->string('video')->nullable(); // Untuk menampung video
        $table->dropColumn(['nama_pemilik', 'no_telp', 'email', 'alamat']); // Hapus karena pake data Sales
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
