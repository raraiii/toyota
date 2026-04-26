<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        // Hanya mengambil mobil milik user yang sedang login
        $mobils = Mobil::where('user_id', Auth::id())
                       ->latest()
                       ->get();

        return view('sales.mobil.index', compact('mobils'));
    }

    public function create() 
    {
        return view('sales.mobil.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nama_mobil'     => 'required',
            'tahun'          => 'required|numeric',
            'km'             => 'required|numeric',
            'warna'          => 'required',
            'kategori'       => 'required',
            'deskripsi'      => 'nullable',
            'fotos.*'        => 'image|mimes:jpeg,png,jpg|max:2048',
            'videos.*'       => 'mimes:mp4,mov,ogg,qt|max:51200',
            'nama_pemilik'   => 'required',
            'telp_pemilik'   => 'required',
            'email_pemilik'  => 'nullable|email',
            'alamat_pemilik' => 'nullable',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $fotoPaths[] = $foto->store('mobil/fotos', 'public');
            }
        }

        $videoPaths = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPaths[] = $video->store('mobil/videos', 'public');
            }
        }

        Mobil::create([
            'user_id'        => Auth::id(),
            'nama_mobil'     => $request->nama_mobil,
            'tahun'          => $request->tahun,
            'km'             => $request->km,
            'warna'          => $request->warna,
            'kategori'       => $request->kategori,
            'deskripsi'      => $request->deskripsi,
            'nama_pemilik'   => $request->nama_pemilik,
            'telp_pemilik'   => $request->telp_pemilik,
            'email_pemilik'  => $request->email_pemilik,
            'alamat_pemilik' => $request->alamat_pemilik,
            'fotos'          => $fotoPaths,
            'videos'         => $videoPaths,
        ]);

        return redirect()->route('sales.mobil.index')->with('success', 'Unit berhasil disimpan!');
    }

    public function show(Mobil $mobil) 
    {
        if ($mobil->user_id !== Auth::id()) abort(403);
        return view('sales.mobil.show', compact('mobil'));
    }

    public function edit(Mobil $mobil) 
    {
        if ($mobil->user_id !== Auth::id()) abort(403);
        return view('sales.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil) 
    {
        if ($mobil->user_id !== Auth::id()) abort(403);

        $request->validate([
            'nama_mobil'     => 'required',
            'tahun'          => 'required|numeric',
            'km'             => 'required|numeric',
            'warna'          => 'required',
            'kategori'       => 'required',
            'deskripsi'      => 'nullable',
            'fotos.*'        => 'image|mimes:jpeg,png,jpg|max:2048',
            'videos.*'       => 'mimes:mp4,mov,ogg,qt|max:51200',
            'nama_pemilik'   => 'required',
            'telp_pemilik'   => 'required',
            'email_pemilik'  => 'nullable|email',
            'alamat_pemilik' => 'nullable',
        ]);

        $fotoPaths = $mobil->fotos;
        if ($request->hasFile('fotos')) {
            foreach ($mobil->fotos ?? [] as $old) Storage::disk('public')->delete($old);
            $fotoPaths = [];
            foreach ($request->file('fotos') as $f) $fotoPaths[] = $f->store('mobil/fotos', 'public');
        }

        $videoPaths = $mobil->videos;
        if ($request->hasFile('videos')) {
            foreach ($mobil->videos ?? [] as $old) Storage::disk('public')->delete($old);
            $videoPaths = [];
            foreach ($request->file('videos') as $v) $videoPaths[] = $v->store('mobil/videos', 'public');
        }

        $mobil->update([
            'nama_mobil'     => $request->nama_mobil,
            'tahun'          => $request->tahun,
            'km'             => $request->km,
            'warna'          => $request->warna,
            'kategori'       => $request->kategori,
            'deskripsi'      => $request->deskripsi,
            'nama_pemilik'   => $request->nama_pemilik,
            'telp_pemilik'   => $request->telp_pemilik,
            'email_pemilik'  => $request->email_pemilik,
            'alamat_pemilik' => $request->alamat_pemilik,
            'fotos'          => $fotoPaths,
            'videos'         => $videoPaths,
        ]);

        return redirect()->route('sales.mobil.index')->with('success', 'Unit diperbarui!');
    }

    public function destroy(Mobil $mobil) 
    {
        if ($mobil->user_id !== Auth::id()) abort(403);
        foreach ($mobil->fotos ?? [] as $f) Storage::disk('public')->delete($f);
        foreach ($mobil->videos ?? [] as $v) Storage::disk('public')->delete($v);
        $mobil->delete();
        return redirect()->route('sales.mobil.index')->with('success', 'Unit dihapus!');
    }
}