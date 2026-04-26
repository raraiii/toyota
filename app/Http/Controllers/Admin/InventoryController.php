<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mobil; // Pastikan ini sudah ada untuk akses data mobil

class InventoryController extends Controller
{
    public function index()
    {
        $mobil = Mobil::where('status', 'inventory')->latest()->get();

        return view('admin.inventory.index', compact('mobil'));
    }

    public function keSurvei($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->status = 'survei';
        $mobil->save();

        return redirect()->route('admin.survei.index')
            ->with('success', 'Mobil berhasil masuk ke survei');
    }

    public function survei()
    {
        $mobil = Mobil::where('status', 'survei')->get();

        return view('admin.survei.index', compact('mobil'));
    }
}
