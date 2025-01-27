@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Barang</h1>

            <!-- Tombol Tambah Barang dan Pencarian -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">
                    Tambah Barang
                </button>
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
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-warning btnEditBarang" 
                                            data-id="{{ $item->id }}" 
                                            data-nama="{{ $item->nama_barang }}" 
                                            data-kategori="{{ $item->kategori_id }}" 
                                            data-stok="{{ $item->stok }}" 
                                            data-harga="{{ $item->harga }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
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

<!-- Modal Tambah Barang -->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('barang.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="modalEditBarang" tabindex="-1" aria-labelledby="modalEditBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditBarang" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditBarangLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" id="edit_nama_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="edit_kategori_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_stok" class="form-label">Stok</label>
                        <input type="number" name="stok" id="edit_stok" class="form-control" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_harga" class="form-label">Harga</label>
                        <input type="number" name="harga" id="edit_harga" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btnEditBarang').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const kategori = this.dataset.kategori;
            const stok = this.dataset.stok;
            const harga = this.dataset.harga;

            document.getElementById('edit_nama_barang').value = nama;
            document.getElementById('edit_kategori_id').value = kategori;
            document.getElementById('edit_stok').value = stok;
            document.getElementById('edit_harga').value = harga;

            const form = document.getElementById('formEditBarang');
            form.action = `/barang/${id}`;
            
            const modal = new bootstrap.Modal(document.getElementById('modalEditBarang'));
            modal.show();
        });
    });
</script>

@endsection
