@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Laporan</h1>

            <!-- Filter Laporan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('laporan.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Laporan -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporan as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($laporan->currentPage() - 1) * $laporan->perPage() }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td> <!-- Relasi ke barang -->
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <!-- Tombol Cetak -->
                <a href="{{ route('laporan.cetak', request()->all()) }}" class="btn btn-secondary">
                    Cetak Laporan
                </a>

                <!-- Navigasi Pagination -->
                {{ $laporan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
