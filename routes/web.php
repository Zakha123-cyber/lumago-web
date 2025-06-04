<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\BookingController;

// Public routes
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{id}', [WisataController::class, 'show'])->name('wisata.detail');

// // Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/bookings', [ProfileController::class, 'bookings'])->name('profile.bookings');

    Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');

    // Booking routes that require authentication
    Route::post('/wisata/{id}/book', [WisataController::class, 'book'])->name('wisata.book');
});

// Route::get('/wisata', function () {
//     return view('welcome.landing');
// });



Route::get('/detail', function () {
    return view('detail-page.detail-wisata');
});

Route::get('/profil', function () {
    return view('profile-page.profile-page');
});

require __DIR__ . '/auth.php';
