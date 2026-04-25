<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index() {
        $data_mobil = Mobil::all();
        return view('admin.mobil.index', compact('data_mobil'));
    }

    public function create() {
        return view('admin.mobil.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama_mobil' => 'required', 'tahun' => 'required|numeric',
            'km' => 'required|numeric', 'warna' => 'required',
            'kategori' => 'required', 'nama_pemilik' => 'required',
            'no_telp' => 'required', 'email' => 'required|email',
            'alamat' => 'required', 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        Mobil::create($data);
        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil ditambah!');
    }

    public function edit($id) {
        $mobil = Mobil::findOrFail($id);
        return view('admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, $id) {
        $mobil = Mobil::findOrFail($id);
        $data = $request->validate([
            'nama_mobil' => 'required', 'tahun' => 'required|numeric',
            'km' => 'required|numeric', 'warna' => 'required',
            'kategori' => 'required', 'nama_pemilik' => 'required',
            'no_telp' => 'required', 'email' => 'required|email',
            'alamat' => 'required', 'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($mobil->foto) Storage::disk('public')->delete($mobil->foto);
            $data['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        $mobil->update($data);
        return redirect()->route('admin.mobil.index')->with('success', 'Data diperbarui!');
    }

    public function destroy($id) {
        $mobil = Mobil::findOrFail($id);
        if ($mobil->foto) Storage::disk('public')->delete($mobil->foto);
        $mobil->delete();
        return redirect()->route('admin.mobil.index')->with('success', 'Data dihapus!');
    }
}