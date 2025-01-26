<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-white text-dark shadow-sm min-vh-100 p-3" style="width: 250px;">
            <h4 class="mb-4">Dashboard Admin</h4>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-1">
                    <a href="{{ url('/dashboard') }}" class="nav-link text-dark {{ request()->is('dashboard') ? 'active bg-light' : '' }}">
                        <i class="bi bi-house-door-fill me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ url('/barang') }}" class="nav-link text-dark {{ request()->is('barang') ? 'active bg-light' : '' }}">
                        <i class="bi bi-box-seam me-2"></i> Barang
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ url('/kategori') }}" class="nav-link text-dark {{ request()->is('kategori') ? 'active bg-light' : '' }}">
                        <i class="bi bi-tag-fill me-2"></i> Kategori
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ url('/transaksi') }}" class="nav-link text-dark {{ request()->is('transaksi') ? 'active bg-light' : '' }}">
                        <i class="bi bi-cash-stack me-2"></i> Transaksi
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ url('/laporan') }}" class="nav-link text-dark {{ request()->is('laporan') ? 'active bg-light' : '' }}">
                        <i class="bi bi-file-earmark-text-fill me-2"></i> Laporan
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
