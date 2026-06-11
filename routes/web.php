<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Halaman login (form)
Route::get('/', [AuthController::class, 'showLogin'])->name('login.form');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Protect halaman products
Route::middleware('auth')->group(function() {
    Route::resource('products', ProductController::class);
});