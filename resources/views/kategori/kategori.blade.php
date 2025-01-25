@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Kategori</h1>

            <!-- Tombol Tambah Kategori dan Pencarian -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                    Tambah Kategori
                </a>
                <form class="d-flex" method="GET" action="{{ route('kategori.index') }}">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari kategori..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                </form>
            </div>

            <!-- Tabel Kategori -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $index => $category)
                                <tr>
                                    <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('kategori.edit', $category->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada kategori ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
