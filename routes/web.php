<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard');

Route::resource('/kategori', KategoriController::class);

Route::resource('/barang', BarangController::class);

Route::get('/transaksi', function () {
    return "Halaman Transaksi";
});

Route::get('/laporan', function () {
    return "Halaman Laporan";
});
