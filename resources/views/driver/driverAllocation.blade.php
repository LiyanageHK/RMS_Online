@extends('layouts.app')

@section('content')
    <div class="allocation-container">

        <div class="header">
            <h1>Allocate Driver for Order #{{ $order->id }}</h1>
        </div>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('driver.storeAllocation') }}" method="POST" class="allocation-form" id="allocationForm">
            @csrf

            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="address" value="{{ $delivery->address ?? $order->address }}">
            <input type="hidden" name="landmark" value="{{ $delivery->landmark ?? '' }}">
            <input type="hidden" name="phone" value="{{ $delivery->phone ?? $order->phone }}">
            <input type="hidden" name="total" value="{{ $delivery->total ?? $order->total }}">


            <div class="form-group">
                <label>Address:</label>
                <input type="text" value="{{ $delivery->address ?? $order->address }}" readonly class="input-field">
            </div>

            <div class="form-group">
                <label>Landmark:</label>
                <input type="text" value="{{ $delivery->landmark ?? 'Not specified' }}" readonly class="input-field">
            </div>

            <div class="form-group">
                <label>Phone:</label>
                <input type="text" value="{{ $delivery->phone ?? $order->phone }}" readonly class="input-field">
            </div>

            <div class="form-group">
                <label>Order Total:</label>
                <input type="number" value="{{ $delivery->total ?? $order->total }}" readonly class="input-field">
            </div>

            <div class="form-group">
                <label for="driver_id">Select Driver:</label>
                <select name="driver_id" id="driver_id" class="input-field" required>
                    <option value="">-- Select Driver --</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ (optional($delivery)->driver_id == $driver->id) ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="submit-button">Allocate Driver</button>
        </form>
    </div>

    <style>
        .allocation-container {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #ffffff;
            padding: 20px 30px;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .alert {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .allocation-form {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        // Add success message pop-up functionality
        @if (session('success'))
            window.onload = function() {
               alert('{{ session('success') }}'); // Show the pop-up message
                window.location.href = '{{ route('driver.pendingAllocation') }}'; // Redirect to the pending allocation page
            };
        @endif
    </script>


@endsection
