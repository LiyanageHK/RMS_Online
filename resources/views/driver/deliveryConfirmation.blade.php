@extends('layouts.app')

@section('title', 'Dispatched Orders')

@section('content')
<div style="padding: 20px;">
    <h1 style="font-weight: bold;">Dispatched Orders</h1>




    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Order ID</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Name</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Address</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Landmark</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Phone</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Total</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Payment Status</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Order Status</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->id }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->name }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->address }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->landmark ?? '-' }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->phone }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">Rs. {{ number_format($order->total, 2) }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->payment_status }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->order_status }}</td>
                    <td style="padding: 12px; border: 1px solid #ddd;">
                        <form method="POST" action="{{ route('admin.driver.orders.markDelivered', $order->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to mark this order as Delivered?')"
                                style="background-color: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                                Delivered
                            </button>
                        </form>



                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                        No dispatched orders available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
