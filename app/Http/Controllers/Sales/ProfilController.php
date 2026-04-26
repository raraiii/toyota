<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('sales.profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nomor_telepon' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->nomor_telepon = $request->nomor_telepon;

        // Update Password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update Foto
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $path = $request->file('foto')->store('profil', 'public');
            $user->foto = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil Toyota Connect Anda berhasil diperbarui!');
    }
}