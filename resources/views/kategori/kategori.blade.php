@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Kategori</h1>

            <!-- Tombol Tambah Kategori dan Pencarian -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Tombol Tambah Kategori -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    Tambah Kategori
                </button>

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
                                    <td>{{ $category->nama_kategori }}</td>
                                    <td class="text-center">
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" 
                                            data-bs-target="#editCategoryModal"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->nama_kategori }}">
                                            Edit
                                        </button>
                        
                                        <!-- Tombol Hapus -->
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

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('kategori.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Masukkan nama kategori" required>
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Kategori -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="edit_nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Masukkan nama kategori" required>
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const editCategoryModal = document.getElementById('editCategoryModal');
    editCategoryModal.addEventListener('show.bs.modal', function (event) {
        // Ambil tombol yang memicu modal
        const button = event.relatedTarget;

        // Ambil data dari tombol
        const categoryId = button.getAttribute('data-id');
        const categoryName = button.getAttribute('data-name');

        // Isi form modal dengan data
        const modalTitle = editCategoryModal.querySelector('.modal-title');
        const nameInput = editCategoryModal.querySelector('#edit_nama_kategori');
        const form = editCategoryModal.querySelector('#editCategoryForm');

        modalTitle.textContent = `Edit Kategori: ${categoryName}`;
        nameInput.value = categoryName;

        // Atur action form ke URL yang sesuai
        form.action = `/kategori/${categoryId}`;
    });
</script>

@endsection
