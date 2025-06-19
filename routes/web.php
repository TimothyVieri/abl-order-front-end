<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

// Route untuk menampilkan halaman form order
Route::get('/order', [OrderController::class, 'create'])->name('orders.create');

// Route untuk menyimpan data dari form order
Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

// Route untuk halaman sukses (contoh)
Route::get('/order/success', function () {
    return 'Your order has been placed!'; // Buat view yang lebih baik untuk ini
})->name('orders.success');
