<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $transaksi = Transaksi::with('barang') // Pastikan barang ikut dimuat
    ->when($search, function ($query, $search) {
        $query->where('kode_transaksi', 'like', "%$search%")
              ->orWhereHas('barang', function ($query) use ($search) {
                  $query->where('name', 'like', "%$search%");
              });
    })
    ->paginate(7);


        return view('/transaksi/transaksi', compact('transaksi'));
    }

    public function create()
    {
        $barang = Barang::all(); // Mengambil semua data barang
        return view('transaksi.create', compact('barang'));
    }

    public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'jenis_transaksi' => 'required',
        'jumlah' => 'required|integer|min:1',
        'sumber_tujuan' => 'required|string',
        'tanggal' => 'required|date',
    ]);

    $barang = Barang::findOrFail($request->barang_id);

    // Membuat kode transaksi otomatis
    $kodeTransaksi = 'TRX-' . now()->format('Ymd') . '-' . strtoupper(uniqid());

    // Hitung total harga (harga barang x jumlah)
    $subtotal = $barang->harga * $request->jumlah;

    // Simpan transaksi baru
    Transaksi::create([
        'barang_id' => $request->barang_id,
        'kode_transaksi' => $kodeTransaksi, // Simpan kode transaksi
        'jenis_transaksi' => $request->jenis_transaksi,
        'jumlah' => $request->jumlah,
        'sumber_tujuan' => $request->sumber_tujuan,
        'tanggal' => $request->tanggal,
        'total_harga' => $subtotal, // Simpan total harga
    ]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
}

}
