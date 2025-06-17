<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpVerificationMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'phone'    => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Generate OTP 6 digit
        $otp = rand(100000, 999999);

        // Buat user dengan status belum verifikasi
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'role'        => 'pengunjung',
            'password'    => Hash::make($request->password),
            'otp_code'    => $otp,
            'otp_verified' => false,
        ]);

        // Kirim email OTP
        Mail::to($user->email)->send(new OtpVerificationMail($otp));

        // Simpan user_id ke session untuk proses verifikasi
        session(['otp_user_id' => $user->id]);

        // Tidak login otomatis, redirect ke halaman verifikasi OTP
        return redirect()->route('otp.verify.form')->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }
}
