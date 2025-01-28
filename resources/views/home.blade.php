@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Row untuk Card Informasi -->
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Total Barang</h6>
                        <p class="fs-4 fw-bold mb-0">{{ $totalBarang }}</p>
                    </div>
                    <i class="bi bi-box-seam fs-2 text-primary"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Kategori</h6>
                        <p class="fs-4 fw-bold mb-0">{{ $totalKategori }}</p>
                    </div>
                    <i class="bi bi-tag-fill fs-2 text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Total Transaksi</h6>
                        <p class="fs-4 fw-bold mb-0">{{ $totalTransaksi }}</p>
                    </div>
                    <i class="bi bi-cash-stack fs-2 text-warning"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Grafik -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="card-title">Grafik Transaksi</h6>
                    <canvas id="transaksiChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="card-title">Grafik Stok Barang</h6>
                    <canvas id="stokChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data transaksi per bulan
    var transaksiCtx = document.getElementById('transaksiChart').getContext('2d');
    var transaksiChart = new Chart(transaksiCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($bulanTransaksi) !!},
            datasets: [{
                label: 'Jumlah Transaksi',
                data: {!! json_encode($jumlahTransaksi) !!},
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 2,
                fill: false
            }]
        }
    });

    // Data stok barang
    var stokCtx = document.getElementById('stokChart').getContext('2d');
    var stokChart = new Chart(stokCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($namaBarang) !!},
            datasets: [{
                label: 'Stok Barang',
                data: {!! json_encode($stokBarang) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1
            }]
        }
    });
</script>

@endsection
