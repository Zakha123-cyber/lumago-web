<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LandingController;
// use App\Http\Controllers\WisataController;

// //Landing Page
// Route::get('/', [LandingController::class, 'index'])->name('landing.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     //Detail Wisata
//     Route::prefix('wisata')->group(function () {
//         Route::get('/', [WisataController::class, 'index'])->name('wisata.index');
//         Route::get('/{id}', [WisataController::class, 'show'])->name('wisata.detail');
//     });
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WisataController;

// Public routes
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{id}', [WisataController::class, 'show'])->name('wisata.detail');

// // Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/bookings', [ProfileController::class, 'bookings'])->name('profile.bookings');

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
