<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard');

Route::get('/barang', function () {
    return "Halaman Barang";
});

Route::get('/kategori', function () {
    return "Halaman Kategori";
});

Route::get('/transaksi', function () {
    return "Halaman Transaksi";
});

Route::get('/laporan', function () {
    return "Halaman Laporan";
});
