<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;

// Route untuk menampilkan halaman form order
Route::get('/order', [OrderController::class, 'create'])->name('orders.create');

// Route untuk menyimpan data dari form order
Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

Route::get('/order/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');

// Route untuk halaman sukses (contoh)
Route::get('/order/success', function () {
    return 'Your order has been placed!'; // Buat view yang lebih baik untuk ini
})->name('orders.success');

// Route::get('/order-details', [OrderDetailController::class, 'index']);
// Route::post('/order-details', [OrderDetailController::class, 'store']);

