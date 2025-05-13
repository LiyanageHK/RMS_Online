@extends('layouts.app')

@section('content')
    <div class="allocation-container">
        <h2>Delivery History</h2>

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

        @if ($deliveries->isEmpty())
            <p>No deliveries found.</p>
        @else
            <table class="driver-table">
                <thead>
                    <tr>
                        <th>Delivery ID</th>
                        <th>Order ID</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Driver Allocated</th>
                        <th>Total Amount</th>
                        <th>Driver Allocate At</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveries as $delivery)
                        <tr>

                            <td>{{ 'DLY#' . str_pad($delivery->delivery_id, 4, '0', STR_PAD_LEFT) }}</td>

                            <td>{{ $delivery->order_id }}</td>
                            <td>{{ $delivery->address ?? 'N/A' }}</td>
                            <td>{{ $delivery->phone ?? 'N/A' }}</td>
                            <td>{{ $delivery->assigned_to ?? 'N/A' }}</td>
                            <td>{{ $delivery->total ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($delivery->created_at)->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

<style>
    .allocation-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .alert.success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    .alert.error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }

    .driver-table {
        width: 100%;
        border-collapse: collapse;
    }

    .driver-table th, .driver-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .driver-table th {
        background-color: #7e848a;
        color: white;
    }

    .driver-table tr:hover {
        background-color: #f1f1f1;
    }
</style>
