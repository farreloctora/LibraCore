<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WelcomeController extends Controller
{
    public function index()
    {
        // Mengambil data buku populer dari database
        $books = \App\Models\Koleksi::with('category')->take(5)->get();

        return view('welcome', compact('books'));
    }
}