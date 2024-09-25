<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\MutasiController;
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

Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, "Login"]);

// Middleware untuk melindungi semua endpoint berikutnya
Route::middleware('auth:sanctum')->group(function () {
    // User Auth
    Route::get('/users', [UserController::class, 'userAuth']);

    // CRUD untuk Barang
    Route::apiResource('barangs', BarangController::class);

    // CRUD untuk Mutasi
    Route::apiResource('mutasis', MutasiController::class);

    // Route untuk mendapatkan history mutasi berdasarkan barang
    Route::get('barangs/{id}/mutasi', [BarangController::class, 'showHistory']);

    // Route untuk mendapatkan history mutasi berdasarkan user
    Route::get('users/{id}/mutasi', [UserController::class, 'showHistory']);
});
