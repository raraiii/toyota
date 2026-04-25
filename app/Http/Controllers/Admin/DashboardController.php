<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil; // Tambahkan ini!


class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data mobil
        $data_mobil = Mobil::all();
        
        // Kirim ke view dashboard
        return view('admin.dashboard', compact('data_mobil'));
    }
}