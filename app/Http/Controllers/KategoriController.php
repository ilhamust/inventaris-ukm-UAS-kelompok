<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $categories = Kategori::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(7); // Sesuaikan jumlah per halaman

    return view('/kategori/kategori', compact('categories'));
}

public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    // Simpan kategori ke database
    Kategori::create([
        'nama_kategori' => $request->input('nama_kategori'),
    ]);

    // Redirect ke halaman daftar kategori dengan pesan sukses
    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
}
public function update(Request $request, Kategori $kategori)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    $kategori->update([
        'nama_kategori' => $request->input('nama_kategori'),
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
}
public function destroy(Kategori $kategori)
{
    try {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('kategori.index')->with('error', 'Terjadi kesalahan saat menghapus kategori.');
    }
}


}
