<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct() { $this->middleware('guest'); }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'otp' => ['required', function ($attribute, $value, $fail) {
                if ($value != session('temp_otp')) {
                    $fail('Kode OTP yang Anda masukkan salah.');
                }
            }],
        ]);
    }

    protected function create(array $data)
    {
        session()->forget(['temp_otp', 'temp_email']);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_verified' => true,
        ]);
    }

    // Fungsi ini menangani respon setelah user berhasil dibuat
   protected function registered(Request $request, $user)
{
    Auth::logout();
    if ($request->ajax()) {
        return response()->json([
            'success' => true, 
            'message' => 'Akun berhasil dibuat!',
            'redirect' => route('login')
        ]);
    }
    return redirect()->route('login');
}
}