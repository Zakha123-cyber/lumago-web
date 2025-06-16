<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\Admin\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\Admin\SuperAdmin\SuperAdminWisataController;
use App\Http\Controllers\Admin\SuperAdmin\SuperAdminUserController;
use App\Http\Controllers\Admin\SuperAdmin\SuperAdminTransaksiController;
use App\Http\Controllers\Admin\SuperAdmin\SuperAdminAdminWisataController;

use App\Http\Controllers\Admin\AdminWisata\AdminWisataDashboardController;
use App\Http\Controllers\Admin\AdminWisata\AdminWisataWisataController;
use App\Http\Controllers\Admin\AdminWisata\AdminWisataTransaksiController;
use App\Http\Controllers\Admin\AdminWisata\AdminWisataPengunjungController;
use App\Http\Controllers\Admin\AdminWisata\AdminWisataScanController;

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
    Route::get('/booking/payment/{id}', [BookingController::class, 'payment'])->name('booking.payment');
    Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');
    Route::get('/booking/ticket/{id}', [BookingController::class, 'showTicket'])->name('booking.show-ticket'); // Add this new route

    // Booking routes that require authentication
    Route::post('/wisata/{id}/book', [WisataController::class, 'book'])->name('wisata.book');
});


// Superadmin Routes
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])
        ->name('dashboard.index');

    // Wisata Management
    Route::resource('wisata', SuperAdminWisataController::class)->names([
        'index' => 'wisata.index',
        'create' => 'wisata.create',
        'store' => 'wisata.store',
        'show' => 'wisata.show',
        'edit' => 'wisata.edit',
        'update' => 'wisata.update',
        'destroy' => 'wisata.destroy',
    ]);

    // Kategori Wisata Management
    Route::post('/kategori', [SuperAdminWisataController::class, 'storeKategori'])->name('kategori.store');

    // Gambar Wisata Management
    Route::post('/gambar-wisata', [SuperAdminWisataController::class, 'storeGambar'])->name('gambar-wisata.store');

    // Admin Wisata Management
    Route::resource('admin-wisata', SuperAdminAdminWisataController::class)->names([
        'index' => 'admin-wisata.index',
        'create' => 'admin-wisata.create',
        'store' => 'admin-wisata.store',
        'show' => 'admin-wisata.show',
        'edit' => 'admin-wisata.edit',
        'update' => 'admin-wisata.update',
        'destroy' => 'admin-wisata.destroy',
    ]);

    // Transaksi Management
    Route::resource('transaksi', SuperAdminTransaksiController::class)->names([
        'index' => 'transaksi.index',
        'show' => 'transaksi.show',
        'destroy' => 'transaksi.destroy',
    ])->only(['index', 'show', 'destroy']);

    // User Management
    Route::resource('users', SuperAdminUserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
});

// AdminWisata Routes
Route::middleware(['auth', 'role:adminwisata'])->prefix('admin-wisata')->name('admin-wisata.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminWisataDashboardController::class, 'index'])->name('dashboard.index');

    // Scan Tiket
    Route::get('/scan-tiket', [AdminWisataScanController::class, 'index'])->name('scan.index');
    Route::post('/scan-tiket/import', [AdminWisataScanController::class, 'import'])->name('scan.import');
    Route::get('/scan-tiket/show/{order_id}', [AdminWisataScanController::class, 'show'])->name('scan.show');
    Route::post('/scan-tiket/verify/{order_id}', [AdminWisataScanController::class, 'verify'])->name('scan.verify');


    // Wisata Management
    Route::resource('wisata', AdminWisataWisataController::class)->names([
        'index' => 'wisata.index',
        'create' => 'wisata.create',
        'store' => 'wisata.store',
        'show' => 'wisata.show',
        'edit' => 'wisata.edit',
        'update' => 'wisata.update',
        'destroy' => 'wisata.destroy',
    ]);

    // Transaksi Management
    Route::resource('transaksi', AdminWisataTransaksiController::class)->names([
        'index' => 'transaksi.index',
        'show' => 'transaksi.show',
    ])->only(['index', 'show']);

    // Pengunjung Management
    Route::resource('pengunjung', AdminWisataPengunjungController::class)->names([
        'index' => 'pengunjung.index',
        'show' => 'pengunjung.show',
    ])->only(['index', 'show']);

    Route::prefix('tempat-wisata')->name('tempat-wisata.')->group(function () {
        Route::get('/gambar', [AdminWisataWisataController::class, 'gambar'])->name('gambar');
        Route::post('/{wisata}/gambar', [AdminWisataWisataController::class, 'gambarStore'])->name('gambar.store');
        Route::delete('/{wisata}/gambar/{gambar}', [AdminWisataWisataController::class, 'gambarDestroy'])->name('gambar.destroy');
    });
});

require __DIR__ . '/auth.php';
