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
        // Hindari duplikat username
        if (User::where('username', $row['username'])->exists()) {
            return null;
        }

       return new User([
        'name'     => $row[0],
        'email'    => $row[1], // Pastikan index ini benar-benar email di file excelnya
        'nomor_telepon' => $row[2],
        'password' => Hash::make($row[3]),
        'role'     => 'sales',
        'is_active'=> true,
    ]);
    }
}