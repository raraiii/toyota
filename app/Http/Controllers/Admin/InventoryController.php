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

    public function status($filter = 'all')
{
    $query = Mobil::query();

    if ($filter == 'lolos') {
        $query->where('status', 'deal');
    } elseif ($filter == 'gagal') {
        $query->where('status', 'gagal');
    } else {
        $query->whereIn('status', ['deal', 'gagal']);
    }

    $mobil = $query->latest()->get();

    return view('admin.status.index', compact('mobil', 'filter'));
}

    public function lolos($id)
{
    $mobil = Mobil::findOrFail($id);
    $mobil->status = 'deal';
    $mobil->save();

    return redirect()->route('admin.status.index', 'lolos')
        ->with('success', 'Mobil lolos');
}

public function gagal($id)
{
    $mobil = Mobil::findOrFail($id);
    $mobil->status = 'gagal';
    $mobil->save();

    return redirect()->route('admin.status.index', 'gagal')
        ->with('success', 'Mobil tidak lolos');
}
}
