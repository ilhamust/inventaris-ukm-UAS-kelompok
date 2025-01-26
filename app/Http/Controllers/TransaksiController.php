<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;


class TransaksiController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $transaksi = Transaksi::with('barang') // Relasi ke barang
        ->when($search, function ($query, $search) {
            $query->where('kode_transaksi', 'like', "%$search%")
                  ->orWhereHas('barang', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%");
                  });
        })
        ->paginate(7); // Pagination 10 item per halaman

    return view('/transaksi/transaksi', compact('transaksi'));
}

}
