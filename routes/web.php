<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;

// Route untuk menampilkan halaman form order
Route::get('/order', [OrderController::class, 'create'])->name('orders.create');

// Route untuk menyimpan data dari form order
Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
