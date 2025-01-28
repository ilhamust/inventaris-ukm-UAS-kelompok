<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('/auth/login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::resource('/kategori', KategoriController::class);
Route::resource('/barang', BarangController::class);
Route::resource('/transaksi', TransaksiController::class);
Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
Route::resource('/laporan', LaporanController::class);
