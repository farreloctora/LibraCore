<?php

use Illuminate\Support\Facades\Route;

// Public Koleksi Routes
Route::view('/koleksi', 'koleksi')->name('koleksi');
Route::get('/koleksi/{koleksi}', [KoleksiController::class, 'show'])->name('koleksi.show');
Route::post('/koleksi/{koleksi}/pinjam', [KoleksiController::class, 'pinjam'])->middleware('auth')->name('koleksi.pinjam');

Route::view('/kategori', 'kategori')->name('kategori');

