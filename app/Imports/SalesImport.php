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
    // Gunakan nama kolom dari header Excel (case-insensitive/slug)
    if (User::where('email', $row['email'])->exists()) {
        return null;
    }

    return new User([
        'name'          => $row['nama'],        // Sesuai header "Nama"
        'email'      => $row['email'],    // Sesuai header "Username"
        'password'      => Hash::make($row['password']), // Sesuai header "Password"
        'nomor_telepon' => $row['no_telepon'], // Sesuai header "No Telepon"
        'role'          => 'sales',
        'is_active'     => true,
    ]);
}
}