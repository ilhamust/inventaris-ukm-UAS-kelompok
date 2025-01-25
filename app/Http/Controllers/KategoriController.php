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

}
