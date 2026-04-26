<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua mobil yang statusnya tersedia
        $mobils = Mobil::where('status_unit', 'tersedia')->latest()->get();

        // Lempar variabel $mobils ke view
        return view('user.dashboard', compact('mobils'));
    }

    public function show($id)
    {
        // Cari mobil berdasarkan ID, sertakan relasi sales untuk ambil nomor WA
        $mobil = Mobil::with('sales')->findOrFail($id);
        
        return view('user.show', compact('mobil'));
    }
}