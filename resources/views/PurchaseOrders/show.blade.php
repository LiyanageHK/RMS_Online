@extends('layouts.app')

@section('content')
<div style="padding: 30px; background-color: #f5f5f5; min-height: 100vh;">
    <div style="max-width: 800px; margin: auto;">
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 28px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="font-size: 22px; font-weight: 600; color: #333;">Purchase Order Details</h2>
                <a href="{{ route('purchase_orders.index') }}"
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #E7592B; color: white; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 14px;">
                    <span class="material-icons" style="font-size: 18px; margin-right: 6px;">arrow_back</span> Back to List
                </a>
            </div>

            <div style="padding: 25px 28px;">
                {{-- PO Header --}}
                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 6px;">PO #{{ str_pad($po->id, 5, '0', STR_PAD_LEFT) }}</h3>
                    <span style="color: #888;">Order Date: {{ \Carbon\Carbon::parse($po->created_at)->format('d M Y') }}</span><br>
                    <span style="color: #555;">Status: {{ ucfirst($po->status) }}</span>
                </div>

                {{-- Supplier Info --}}
                <div style="margin-bottom: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin-bottom: 12px;">Supplier</h4>
                    <p style="margin: 0;">{{ $po->supplier->name }}</p>
                    <p style="color: #666;">{{ $po->supplier->email }} | {{ $po->supplier->phone }}</p>
                </div>

                {{-- Items --}}
                <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin: 20px 0 12px;">Ordered Items</h4>
                <table style="width: 100%; border-collapse: collapse; background-color: #fff;">
                    <thead>
                        <tr style="background-color: #f3f3f3; text-align: left;">
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Item</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Price</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Quantity</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($po->items as $poItem)
                    <tr>
                        <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $poItem->item->name ?? 'N/A' }}</td>
                        <td style="padding: 10px; border-bottom: 1px solid #eee;">Rs. {{ number_format($poItem->price, 2) }}</td>
                        <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $poItem->quantity }}</td>
                        <td style="padding: 10px; border-bottom: 1px solid #eee;">Rs. {{ number_format($poItem->price * $poItem->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right; font-weight: bold; padding: 10px; border-top: 1px solid #ddd;">Total Amount:</td>
                            <td style="padding: 10px; border-top: 1px solid #ddd;">Rs. {{ number_format($po->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
