<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;

class LandingController extends Controller
{
    public function index()
    {
        $destinations = TempatWisata::with(['kategori', 'gambarWisata'])->get();
        return view('welcome.landing', compact('destinations'));
    }
}
