<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    // Tambahkan baris ini
    protected $table = 'mobil';

    // Pastikan fillable juga sudah diisi agar bisa di-save ke database
    protected $fillable = [
        'nama_mobil', 'tahun', 'km', 'warna', 'kategori', 
        'foto', 'nama_pemilik', 'no_telp', 'email', 'alamat'
    ];
}