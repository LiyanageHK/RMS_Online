@extends('layouts.auth')

@section('title', 'Employee Login')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <!-- Email Input -->
    <div class="form-group">
        <div class="input-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   placeholder="Employee Email" name="email" value="{{ old('email') }}" 
                   required autocomplete="email" autofocus>
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <!-- Password Input -->
    <div class="form-group">
        <div class="input-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   placeholder="Employee Password" name="password" required autocomplete="current-password">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <!-- Remember Me & Forgot Password -->
    <div class="remember-forgot">
        <div class="remember-me">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" 
                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        @if (Route::has('password.request'))
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
        @endif
    </div>
    
    <!-- Login Button -->
    <div class="form-group">
        <button type="submit" class="btn btn-secondary btn-block" style="background-color: #E7592B; border-color: #E7592B;">
            Employee Login
        </button>
    </div>
    
    <!-- Divider -->
    <div class="divider">OR</div>
    
    <!-- Register Link -->
    @if (Route::has('register'))
        <div class="form-group">
            <a href="{{ route('register') }}" class="btn btn-secondary">
                Create New Account
            </a>
        </div>
    @endif
</form>
@endsection