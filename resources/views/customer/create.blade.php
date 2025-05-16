@extends('layouts.app')

@section('content')
<style>
    .form-container {
        padding: 20px;
        max-width: 500px;
        margin: auto;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-top: 5px;
    }

    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 3px;
    }

    button {
        background-color: #E7592B;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        margin-top: 15px;
        cursor: pointer;
        width: 100%;
        font-weight: bold;
    }

    button:hover {
        background-color: #cf4f25;
    }
</style>

<div class="form-container">
    <h2>Add New Customer</h2>

    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <div class="error-message">{{ $message }}</div> @enderror

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="error-message">{{ $message }}</div> @enderror

        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>
        @error('phone') <div class="error-message">{{ $message }}</div> @enderror

        <label>Address:</label>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address') <div class="error-message">{{ $message }}</div> @enderror

        <label>Password:</label>
        <input type="password" name="password" required>
        @error('password') <div class="error-message">{{ $message }}</div> @enderror

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required>

        <!-- Profile Image (optional)
        <label>Profile Image:</label>
        <input type="file" name="profile_image">
        @error('profile_image') <div class="error-message">{{ $message }}</div> @enderror
        -->

        <button type="submit">Create</button>
    </form>
</div>
@endsection
