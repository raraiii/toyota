<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <--- Tambahkan ini

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) { // <--- Ganti menjadi Auth::check()
            return redirect('login');
        }

        $user = Auth::user(); // <--- Ganti menjadi Auth::user()

        // 2. Admin memiliki akses penuh ke segalanya
        if ($user->role === 'admin') {
            return $next($request);
        }

        // 3. Cek apakah role user saat ini ada dalam daftar role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 4. Jika bukan admin dan tidak punya akses, tendang ke halaman home
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}