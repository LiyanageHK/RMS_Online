@extends('layouts.app')

@section('title', 'Pending Order Allocation')

@section('content')
    <div style="padding: 20px;">
        <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
                Pending Order Allocation
            </h1>
        </div>

        <!-- Orders Table -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order ID</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Address</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Phone</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order Value</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order Status</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->id }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->address }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->phone }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">Rs. {{ number_format($order->total, 2) }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->order_status }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">
                            <a href="{{ route('admin.driver.allocate', ['order_id' => $order->id]) }}"
                               style="text-decoration: none; background-color: #E7592B; color: white; padding: 10px 20px; border-radius: 5px; display: inline-block; font-weight: bold;">
                                Allocate Driver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 12px; border: 1px solid #ddd; text-align: center;">No orders available for delivery</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Action Buttons -->
        <br><br>
        <div style="display: flex; justify-content: space-between; gap: 12px;">
            <a href="{{ route('admin.driver.allocation.details') }}"
               style="text-decoration: none; background-color: #E7592B; color: white; padding: 12px 20px; border-radius: 5px; text-align: center; font-weight: bold;">
                Driver Allocation Details
            </a>
        </div>
    </div>
@endsection
