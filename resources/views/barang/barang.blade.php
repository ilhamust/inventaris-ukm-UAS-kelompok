@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Barang</h1>

            <!-- Tombol Tambah Barang dan Pencarian -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    Tambah Barang
                </a>
                <form class="d-flex" method="GET" action="{{ route('barang.index') }}">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari barang..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                </form>
            </div>

            <!-- Tabel Barang -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->kategori->name }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada barang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
