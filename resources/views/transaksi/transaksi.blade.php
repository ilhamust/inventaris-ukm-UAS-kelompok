@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Transaksi</h1>

            <!-- Tombol Tambah Transaksi dan Pencarian -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                    Tambah Transaksi
                </a>
                <form class="d-flex" method="GET" action="{{ route('transaksi.index') }}">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari transaksi..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                </form>
            </div>

            <!-- Tabel Transaksi -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($transaksi->currentPage() - 1) * $transaksi->perPage() }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ $item->barang->name }}</td> <!-- Relasi ke barang -->
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada transaksi ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $transaksi->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
