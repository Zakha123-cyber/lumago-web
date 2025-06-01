<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
