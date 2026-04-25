<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendOTPNotification;
use App\Models\User;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['success' => false, 'message' => 'Email sudah terdaftar.'], 422);
        }
        
        $otp = rand(100000, 999999);
        session(['temp_otp' => $otp, 'temp_email' => $request->email]);

        try {
            Notification::route('mail', $request->email)->notify(new SendOTPNotification($otp));
            return response()->json(['success' => true, 'message' => 'OTP dikirim!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal kirim email.'], 500);
        }
    }

    // Fungsi cek OTP Real-time
    public function verifyOtpOnly(Request $request)
    {
        if ($request->otp == session('temp_otp')) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Kode OTP tidak sesuai.']);
    }
}