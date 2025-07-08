@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Nunito', sans-serif;
    }

    .login-container {
        margin-top: 80px;
    }

    .login-card {
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

    .btn-link {
        color: #007bff;
    }

    .form-check-label {
        font-size: 0.9rem;
    }

    .logo-img {
        max-height: 70px;
    }
</style>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-card text-center">
                <img src="{{ asset('img/logo-sis.jpg') }}" class="logo-img mb-2" alt="Logo Sekolah">
                <h5 class="mb-4">SISTEM INFORMASI SEKOLAH</h5>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check text-start">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="mt-3 text-end">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
