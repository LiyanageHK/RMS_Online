@extends('layouts.app')
@section('header')


@extends('layouts.app')

n

@section('content')
<style>
    .form-container {
        padding: 20px;
        max-width: 600px;
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
        font-size: 14px;
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



@section('content')
<style>
    .form-container {
        padding: 20px;
        max-width: 600px;
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
        font-size: 14px;
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
    <h2>Edit Customer</h2>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form id="editForm" action="{{ route('customer.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <div class="error-message">{{ $message }}</div> @enderror

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="error-message">{{ $message }}</div> @enderror

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required pattern="^\d{10}$" title="Phone number must be 10 digits.">
        @error('phone') <div class="error-message">{{ $message }}</div> @enderror
        <div id="phoneError" class="error-message" style="display: none;">Please enter a valid 10-digit phone number.</div>

        <label for="address">Address:</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}">
        @error('address') <div class="error-message">{{ $message }}</div> @enderror

        <label for="password">Password (leave blank to keep current):</label>
        <input type="password" name="password" placeholder="Enter new password if changing">
        @error('password') <div class="error-message">{{ $message }}</div> @enderror

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" placeholder="Confirm new password">
        @error('password_confirmation') <div class="error-message">{{ $message }}</div> @enderror

        <button type="button" onclick="confirmUpdate()">Update</button>
    </form>




    <!-- Confirmation Modal -->
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="background: white; width: 300px; margin: 150px auto; padding: 20px; border-radius: 8px; text-align: center;">
            <p style="margin-bottom: 20px;">Are you sure you want to update this customer?</p>
            <button onclick="submitForm()" style="background-color: red; color: white; padding: 6px 12px; margin-right: 10px; border: none; border-radius: 4px;">Yes</button>
            <button onclick="closeModal()" style="background-color: #e0e0e0; color: #333; padding: 6px 12px; border: none; border-radius: 4px;">Cancel</button>

        </div>
    </div>
</div>


<script>
    function confirmUpdate() {
        const phone = document.getElementById('phone').value;
        const phoneError = document.getElementById('phoneError');
        phoneError.style.display = 'none';

        if (!/^\d{10}$/.test(phone)) {
            phoneError.style.display = 'block';
            return;
        }


        document.getElementById('confirmModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    function submitForm() {
        document.getElementById('editForm').submit();
    }
</script>





@endsection
