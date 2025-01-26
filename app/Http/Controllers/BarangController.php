<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $items = Barang::with('kategori') // Mengambil relasi kategori
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(7); // Sesuaikan jumlah per halaman

    return view('/barang/barang', compact('items'));
}

}
