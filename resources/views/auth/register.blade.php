<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Inventaris UKM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-white bg-gradient">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-xl-8 col-lg-10 col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="row g-0">
                        <!-- Left Section -->
                        <div class="col-lg-6 bg-light p-5 d-flex flex-column justify-content-center">
                            <p class="mb-2">Selamat Datang di,</p>
                            <h3 class="mb-3">Inventaris UKM</h3>
                            <p>Daftarkan akunmu untuk memulai manajemen inventarismu!</p>
                        </div>

                        <!-- Right Section -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email Address" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Password -->
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="mb-3">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirm Password" required>
                                    </div>
                                    <!-- Register Button -->
                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>
