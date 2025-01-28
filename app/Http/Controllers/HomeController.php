<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Hitung total data
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalTransaksi = Transaksi::count();

        // Data transaksi per bulan
        $transaksiData = Transaksi::selectRaw('DATE_FORMAT(tanggal, "%M") as bulan, COUNT(*) as jumlah')
                          ->groupBy('bulan')
                          ->orderBy('bulan', 'asc')
                          ->get();
        $bulanTransaksi = $transaksiData->pluck('bulan')->toArray();
        $jumlahTransaksi = $transaksiData->pluck('jumlah')->toArray();


        // Data stok barang
        $barangData = Barang::select('nama_barang', 'stok')->get();
        $namaBarang = $barangData->pluck('nama_barang')->toArray();
        $stokBarang = $barangData->pluck('stok')->toArray();

        return view('home', compact(
            'totalBarang', 'totalKategori', 'totalTransaksi',
            'bulanTransaksi', 'jumlahTransaksi',
            'namaBarang', 'stokBarang'
        ));
    }
}
