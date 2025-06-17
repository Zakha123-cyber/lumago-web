<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OtpVerificationController extends Controller
{
    public function showForm()
    {
        return view('auth.otp-verification');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|digits:6',
        ]);

        $userId = session('otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('register')->withErrors(['email' => 'User tidak ditemukan.']);
        }

        if ($user->otp_code == $request->otp_code) {
            $user->otp_verified = true;
            $user->email_verified_at = Carbon::now();
            $user->save();

            // Login user setelah verifikasi
            Auth::login($user);

            // Hapus session otp
            session()->forget('otp_user_id');

            return redirect()->route('landing.index')->with('success', 'Verifikasi berhasil! Akun Anda telah aktif.');
        } else {
            return back()->withErrors(['otp_code' => 'Kode OTP salah.']);
        }
    }
}
