@extends('layouts.app')

@section('content')
<div style="padding: 20px;">
    <h2>Customer Profile: {{ $user->name }}</h2>

    <br>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone }}</p>
    <p><strong>Address:</strong> {{ $user->address }}</p>
    <p><strong>Registered on:</strong> {{ $user->created_at->format('Y-m-d') }}</p>

        <br>
    <h3>Order History</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f4f4f4;">
            <tr style="text-align: center;">
                <th>Order Number</th>
                <th>Delivered Address</th>
                <th>Delivered Address Landmark</th>
                <th>Bill Amount (Rs.)</th>
                <th>Payment Method</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)

                    <tr style="text-align: center;">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->landmark }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
