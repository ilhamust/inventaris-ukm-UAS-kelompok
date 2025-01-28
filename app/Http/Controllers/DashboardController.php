<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalTransaksi = Transaksi::count();

        // Data transaksi per bulan
        $transaksiData = Transaksi::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
                                  ->groupBy('bulan')
                                  ->orderBy('bulan')
                                  ->get();
        $bulanTransaksi = $transaksiData->pluck('bulan')->toArray();
        $jumlahTransaksi = $transaksiData->pluck('jumlah')->toArray();

        // Data stok barang
        $barangData = Barang::select('nama', 'stok')->get();
        $namaBarang = $barangData->pluck('nama')->toArray();
        $stokBarang = $barangData->pluck('stok')->toArray();

        return view('dashboard', compact(
            'totalBarang', 'totalKategori', 'totalTransaksi',
            'bulanTransaksi', 'jumlahTransaksi',
            'namaBarang', 'stokBarang'
        ));
    }
}
