<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Cek "keamanan": Kalau kolom 'email' kosong, lewati saja (jangan diproses)
        // Ini mencegah error "Undefined array key"
        if (!isset($row['email']) || empty($row['email'])) {
            return null;
        }

        // 2. Cek apakah email sudah ada di database
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        // 3. Masukkan data (menggunakan ?? agar kalau data kosong, tidak error)
        return new User([
            'name'          => $row['nama'] ?? 'Tanpa Nama', 
            'email'         => $row['email'],
            'password'      => Hash::make($row['password'] ?? 'password123'),
            'nomor_telepon' => $row['no_telepon'] ?? null,
            'role'          => 'sales',
            'is_active'     => true,
        ]);
    }
}