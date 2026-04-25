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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->integer('tahun');
            $table->integer('km');
            $table->string('warna');
            $table->enum('kategori', ['fleet', 'rental']);

            // Tambahkan kolom foto di sini
            $table->string('foto');
            
            // Data Pribadi Penjualan
            $table->string('nama_pemilik');
            $table->string('no_telp');
            $table->string('email');
            $table->text('alamat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
