<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobil';
    protected $fillable = [
    'user_id', 'nama_mobil', 'tahun', 'km', 'warna', 'kategori', 'deskripsi',
    'nama_pemilik', 'telp_pemilik', 'email_pemilik', 'alamat_pemilik', 'fotos', 'videos'
];

    protected $casts = [
        'fotos' => 'array',
        'videos' => 'array'
    ];

    public function sales() {
        return $this->belongsTo(User::class, 'user_id');
    }
}