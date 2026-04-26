<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik untuk sales yang sedang login
        $totalUnit = Mobil::where('user_id', Auth::id())->count();
        $unitTerbaru = Mobil::where('user_id', Auth::id())->latest()->take(5)->get();
        
        return view('sales.dashboard', compact('totalUnit', 'unitTerbaru'));
    }
}