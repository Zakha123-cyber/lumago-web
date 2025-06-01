<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WisataController;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
// Wisata Routes
Route::prefix('wisata')->group(function () {
    Route::get('/', [WisataController::class, 'index'])->name('wisata.index');
    Route::get('/{id}', [WisataController::class, 'show'])->name('wisata.detail');
});

Route::get('/wisata', function () {
    return view('welcome.landing');
});

Route::get('/booking', function () {
    return view('booking-page.booking-page');
});

Route::get('/detail', function () {
    return view('detail-page.detail-wisata');
});

Route::get('/profil', function () {
    return view('profile-page.profile-page');
});
