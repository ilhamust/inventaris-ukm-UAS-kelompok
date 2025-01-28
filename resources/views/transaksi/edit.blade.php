@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Transaksi</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('transaksi.update', $transaksi->id) }}">
        @csrf
        @method('PUT')

        <!-- Pilih Barang -->
        <div class="mb-3">
            <label for="barang_id" class="form-label">Barang</label>
            <select name="barang_id" id="barang_id" class="form-select" required>
                @foreach ($barang as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $transaksi->barang_id ? 'selected' : '' }}>
                        {{ $item->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jenis Transaksi -->
        <div class="mb-3">
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                <option value="Masuk" {{ $transaksi->jenis_transaksi == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="Keluar" {{ $transaksi->jenis_transaksi == 'Keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
        </div>

        <!-- Jumlah -->
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="{{ $transaksi->jumlah }}" required>
        </div>

        <!-- Sumber/Tujuan -->
        <div class="mb-3">
            <label for="sumber_tujuan" class="form-label">Sumber/Tujuan</label>
            <input type="text" name="sumber_tujuan" id="sumber_tujuan" class="form-control" value="{{ $transaksi->sumber_tujuan }}" required>
        </div>

        <!-- Tanggal -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $transaksi->tanggal }}" required>
        </div>

        <!-- Submit -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
