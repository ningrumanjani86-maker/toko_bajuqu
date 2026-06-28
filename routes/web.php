<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

// Halaman login (form)
Route::get('/', [AuthController::class, 'showLogin'])->name('login.form');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Protect halaman products
Route::middleware('auth')->group(function() {
    Route::get('/products/download-pdf', [ProductController::class, 'downloadPdf'])->name('products.pdf'); 
    Route::resource('categories', CategoryController::class)->middleware('auth');
    Route::resource('products', ProductController::class)->middleware('auth');
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/history', [TransactionController::class,'history'])->name('transactions.history');
});