<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Tempat tujuan redirect setelah login jika method authenticated tidak ada.
     */
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Secara default Laravel menggunakan email. 
     * Kita pastikan kembali di sini.
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Logika setelah user berhasil memasukkan email & password yang benar.
     */
    protected function authenticated(Request $request, $user)
    {
        // 1. CEK STATUS AKTIF
        // Pastikan kolom 'is_active' ada di tabel users Anda
        if (isset($user->is_active) && !$user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda sedang dinonaktifkan. Silakan hubungi Administrator.',
            ]);
        }

        // 2. REDIRECT BERDASARKAN ROLE
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'sales') {
            return redirect()->route('sales.dashboard'); 
        } elseif ($user->role === 'user' || $user->role === 'client') {
            return redirect()->route('user.dashboard');
        }

        // Default redirect
        return redirect($this->redirectTo);
    }
}