<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - Inventaris UKM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-white bg-gradient">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-xl-8 col-lg-10 col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="h4 text-center text-gray-900 mb-4">Verify Your Email Address</h1>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p class="mb-3">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                        </p>
                        <p>
                            {{ __('If you did not receive the email') }},
                        </p>

                        <!-- Resend Verification Link -->
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                {{ __('click here to request another') }}
                            </button>.
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>
