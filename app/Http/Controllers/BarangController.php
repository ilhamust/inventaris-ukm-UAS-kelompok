<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $kategori = Kategori::all(); // Ambil semua kategori untuk dropdown
    $items = Barang::with('kategori') // Mengambil relasi kategori
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(7); // Sesuaikan jumlah per halaman

    return view('/barang/barang', compact('items', 'kategori','items'));
}

public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategori,id',
        'stok' => 'required|integer|min:0',
        'harga' => 'required|numeric|min:0',
    ]);

    // Simpan barang baru ke database
    Barang::create([
        'nama_barang' => $request->input('nama_barang'),
        'kategori_id' => $request->input('kategori_id'),
        'stok' => $request->input('stok'),
        'harga' => $request->input('harga'),
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
}
public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategori,id',
        'stok' => 'required|integer|min:0',
        'harga' => 'required|numeric|min:0',
    ]);

    // Cari barang dan update
    $barang = Barang::findOrFail($id);
    $barang->update([
        'nama_barang' => $request->input('nama_barang'),
        'kategori_id' => $request->input('kategori_id'),
        'stok' => $request->input('stok'),
        'harga' => $request->input('harga'),
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
}
public function destroy($id)
{
    // Cari barang dan hapus
    $barang = Barang::findOrFail($id);
    $barang->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
}

}
