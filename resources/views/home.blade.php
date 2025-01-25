@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Dashboard</h1>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    {{ __('Welcome') }}
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ __('You are logged in!') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
