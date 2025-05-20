@extends('layouts.auth')

@section('title', 'Employee Login')

@section('content')

<form method="POST" action="{{ route('admin.login') }}">
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


    

    <!-- Login Button -->
    <div class="form-group">
        <button type="submit" class="btn btn-secondary btn-block" style="background-color: #E7592B; border-color: #E7592B;">
            Employee Login
        </button>
    </div>


</form>
@endsection
