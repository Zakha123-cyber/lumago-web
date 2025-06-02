<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WisataController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Landing Page
    Route::get('/', [LandingController::class, 'index'])->name('landing.index');
    //Detail Wisata
    Route::prefix('wisata')->group(function () {
        Route::get('/', [WisataController::class, 'index'])->name('wisata.index');
        Route::get('/{id}', [WisataController::class, 'show'])->name('wisata.detail');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
