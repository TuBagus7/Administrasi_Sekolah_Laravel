@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Nunito', sans-serif;
    }

    .register-container {
        margin-top: 80px;
    }

    .register-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        background-color: #fff;
        padding: 40px 30px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .form-check-label {
        font-size: 0.9rem;
    }

    .logo-img {
        max-height: 70px;
    }
</style>

<div class="container register-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="register-card text-center">
                <img src="{{ asset('img/logo-sis.jpg') }}" class="logo-img mb-2" alt="Logo Sekolah">
                <h5 class="mb-4">SISTEM INFORMASI SEKOLAH</h5>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4 text-start">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password"
                               class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
