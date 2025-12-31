<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\KoleksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Koleksi API Routes
Route::prefix('koleksi')->group(function () {
    Route::get('/', [KoleksiController::class, 'index']);
    Route::post('/', [KoleksiController::class, 'store']);
    Route::get('/{id}', [KoleksiController::class, 'show']);
    Route::put('/{id}', [KoleksiController::class, 'update']);
    Route::patch('/{id}', [KoleksiController::class, 'update']);
    Route::delete('/{id}', [KoleksiController::class, 'destroy']);
});

// Category API Routes
Route::prefix('kategori')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::patch('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

