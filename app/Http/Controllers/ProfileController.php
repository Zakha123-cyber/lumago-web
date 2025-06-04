<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Total transaksi user
        $totalTransaksi = $user->transaksi()->count();

        // Jika admin wisata, hitung tempat wisata & validasi
        $totalTempatWisata = null;
        $totalValidasi = null;
        if ($user->role === 'adminwisata') {
            $totalTempatWisata = $user->tempatWisata()->count();
            $totalValidasi = $user->scanValidasi()->count();
        }

        // Ambil 5 transaksi terbaru beserta relasi wisata
        $recentTransactions = $user->transaksi()
            ->with('wisata')
            ->latest()
            ->take(5)
            ->get();

        return view('profile-page.profile-page', compact(
            'user',
            'totalTransaksi',
            'totalTempatWisata',
            'totalValidasi',
            'recentTransactions'
        ));
    }

    /**
     * Display the user's booking history.
     */
    public function bookings(): View
    {
        $user = Auth::user();
        $bookings = $user->transaksi()
            ->with(['wisata', 'wisata.gambarWisata'])
            ->latest()
            ->paginate(10);

        return view('profile-page.bookings', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
