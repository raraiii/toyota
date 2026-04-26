<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Exports\SalesTemplateExport;
use App\Imports\SalesImport;
use Maatwebsite\Excel\Facades\Excel;

class SalesController extends Controller
{
    // Menampilkan halaman daftar sales
    public function index()
    {
        $sales = User::where('role', 'sales')->latest()->get();
        return view('admin.sales.index', compact('sales'));
    }

    // Menampilkan halaman form tambah sales
    public function create()
    {
        return view('admin.sales.create');
    }

    // Fungsi untuk mengubah status Aktif / Tidak Aktif
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Membalikkan status boolean
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', 'Status akun ' . $user->name . ' berhasil diubah!');
    }

    // Fungsi untuk menghapus akun secara permanen
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Hapus foto dari storage jika ada
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }
        
        $user->delete();

        return redirect()->back()->with('success', 'Akun ' . $user->name . ' berhasil dihapus permanen!');
    }

    // Proses simpan data sales (satuan)
    public function store(Request $request)
    {
        // FIX: Validasi diperbaiki
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Gunakan Email untuk login
            'username' => 'nullable|string|max:255|unique:users', // Opsional
            'nomor_telepon' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        // FIX: Mapping database diperbaiki agar email tidak tertukar dengan username
        User::create([
            'name' => $request->name,
            'email' => $request->email, // Alamat email masuk ke kolom email
            'username' => $request->username ?? $request->name, // Jika username kosong, isi dengan nama
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
            'role' => 'sales',
            'is_active' => true, // Default akun baru aktif
            'foto' => $fotoPath
        ]);

        return redirect()->route('admin.sales.index')->with('success', 'Akun Sales berhasil dibuat!');
    }

    // Fitur Reset Password
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password ' . $user->name . ' berhasil diperbarui!');
    }

    // Download Template Excel (.xlsx)
    public function downloadTemplate()
    {
        return Excel::download(new SalesTemplateExport, 'template_sales.xlsx');
    }

    // Import Excel (.xlsx)
    public function import(Request $request)
    {
        $request->validate([
            'file_import' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new SalesImport, $request->file('file_import'));

        return redirect()->route('admin.sales.index')->with('success', 'Data Sales berhasil diimport!');
    }
}