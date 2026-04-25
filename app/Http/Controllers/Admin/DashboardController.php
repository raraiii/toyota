<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Wajib tambahkan dua baris ini agar Laravel tahu letak Model-nya
use App\Models\User; 
use App\Models\Mobil; 

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data mobil
        $data_mobil = Mobil::latest()->get(); 
        
        // Menghitung jumlah akun dengan role 'sales'
        $total_sales = User::where('role', 'sales')->count();
        
        // Menghitung jumlah akun dengan role 'user' (sesuai dengan rolenya)
        $total_user = User::where('role', 'user')->count(); 

        return view('admin.dashboard', compact('data_mobil', 'total_sales', 'total_user'));
    }
}