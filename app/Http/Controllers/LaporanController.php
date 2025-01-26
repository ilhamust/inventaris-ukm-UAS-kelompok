<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

    $laporan = Transaksi::with('barang')
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('tanggal', [$start_date, $end_date]);
        })
        ->paginate(10);

    return view('laporan/laporan', compact('laporan'));
}

public function cetak(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

    // Ambil data laporan berdasarkan filter tanggal
    $laporan = Transaksi::with('barang')
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('tanggal', [$start_date, $end_date]);
        })
        ->get();

    // Load view laporan_cetak.blade.php dengan data laporan
    $pdf = Pdf::loadView('laporan/laporan_cetak', [
        'laporan' => $laporan,
        'start_date' => $start_date,
        'end_date' => $end_date,
    ]);

    // Download file PDF
    return $pdf->download('laporan-transaksi.pdf');
}

}
