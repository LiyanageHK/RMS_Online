{{-- resources/views/driver/allocation_details.blade.php --}}
@extends('layouts.app')

@section('content')

    <div style="padding: 20px;">

        <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
                Driver Allocation Details
            </h1>
        </div>

        <!-- Deliveries Table -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ddd;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Delivery ID</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Order ID</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Address</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Landmark</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Phone</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Total</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Assigned To</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left; font-weight: bold;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deliveries as $delivery)
                    <tr>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $delivery->delivery_id }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">ORD-{{ $delivery->order_id }}                        </td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $delivery->address }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $delivery->landmark }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $delivery->phone }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">Rs. {{ number_format($delivery->total, 2) }}</td>
                        <td style="padding: 12px; border: 1px solid #ddd;">{{ $delivery->assigned_to }}</td>




                                 <td style="padding: 12px; border: 1px solid #ddd;">
                                    <a href="{{ route('driver.edit.delivery', ['delivery_id' => $delivery->delivery_id]) }}"
                                       style="background-color: #007bff; color: white; padding: 8px 16px; border-radius: 5px; font-weight: bold; text-decoration: none; margin-right: 5px; display: inline-block;">
                                        Edit
                                    </a>


                                <form action="{{ route('driver.delete.delivery', ['delivery_id' => $delivery->delivery_id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this delivery?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #e7592b; color: white; padding: 8px 16px; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;">
                                        Delete
                                    </button>
                                </form>
                            </td>



                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 12px; border: 1px solid #ddd; text-align: center;">No delivery details available</td>
                    </tr>
                @endforelse


                <div style="margin: 20px 0;">
                    <a href="{{ route('driver.pendingAllocation') }}"
                       style="text-decoration: none; color: #007bff; font-weight: bold; font-size: 16px;">
                        ← Back to Pending Allocations
                    </a>
                </div>

            </tbody>
        </table>

    </div>

@endsection
