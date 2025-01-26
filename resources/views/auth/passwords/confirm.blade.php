<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirm Password - Inventaris UKM</title>

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
                            <p class="mb-2">Konfirmasi Password,</p>
                            <h3 class="mb-3">Inventaris UKM</h3>
                        </div>

                        <!-- Right Section -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Confirm Password</h1>
                                    <p class="mb-3">Silakan konfirmasi kata sandi Anda sebelum melanjutkan.</p>
                                </div>
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required
                                            autocomplete="current-password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Confirm Password Button -->
                                    <button type="submit" class="btn btn-primary w-100">Confirm Password</button>
                                </form>
                                <!-- Forget Password Link -->
                                @if (Route::has('password.request'))
                                    <div class="text-center mt-3">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa Kata Sandi?</a>
                                    </div>
                                @endif
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
