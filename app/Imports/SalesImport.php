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
            'name'          => $row['nama'],
            'username'      => $row['username'],
            'nomor_telepon' => $row['no_telepon'],
            'password'      => Hash::make($row['password']),
            'role'          => 'sales',
        ]);
    }
}