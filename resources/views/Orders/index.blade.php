@extends('layouts.app')

@section('content')
<div style="padding: 30px; background-color: #f5f5f5;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size: 20px; font-weight: bold;">Orders</h2>

        <form method="GET" action="{{ route('orders.index') }}" id="searchForm" style="display: flex; gap: 20px; align-items: center;">
            <select name="status" onchange="document.getElementById('searchForm').submit();"
                style="padding: 10px 30px 10px 10px; border: 1px solid #ccc; border-radius: 6px; width: 200px; background-position: 95% center;">
                <option value="">All Statuses</option>
                @foreach(['Ordered', 'Confirmed', 'Preparing'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            
            <input type="text" name="order_number" placeholder="Search by Order Number..." value="{{ request('order_number') }}"
                onblur="document.getElementById('searchForm').submit();"
                style="padding: 10px; border: 1px solid #ccc; border-radius: 6px; width: 200px;">  
        </form>
    </div>

    <div style="background: white; padding: 25px 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        @if(session('success'))
            <div style="background-color: #28a745; color: white; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width: 100%; margin-top: 10px; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9f9f9;">
                    <th style="padding: 10px; text-align: left;">Order Number</th>
                    <th style="padding: 10px; text-align: left;">Customer</th>
                    <th style="padding: 10px; text-align: left;">Status</th>
                    <th style="padding: 10px; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td style="padding: 10px;">{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td style="padding: 10px;">{{ $order->name }}</td>
                    <td style="padding: 10px;">{{ ucwords($order->order_status) }}</td>
                    <td style="padding: 10px;">
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            @if($order->order_status === 'Ordered')
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'confirm', this);">
                                    @csrf
                                    <input type="hidden" name="action" value="confirm">
                                    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 6px; cursor: pointer; width: 200px;">
                                        <i class="fas fa-check-circle" style="margin-right: 8px;"></i>Confirm Order
                                    </button>
                                </form>
                            @elseif($order->order_status === 'Confirmed')
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'advance', this);">
                                    @csrf
                                    <button type="submit" style="padding: 10px 20px; background-color: #cccccc; color: black; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; width: 200px;">
                                        <i class="fas fa-cogs" style="margin-right: 8px;"></i>Start Preparation
                                    </button>
                                </form>
                            @elseif($order->order_status === 'Preparing')
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'advance', this);">
                                    @csrf
                                    <button type="submit" style="padding: 10px 20px; background-color: #E7592B; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; width: 200px;">
                                        <i class="fas fa-truck" style="margin-right: 8px;"></i>Ready for Delivery
                                    </button>
                                </form>
                            @endif

                            <!-- Cancel available for all statuses -->
                            <div style="display: inline-flex; gap: 10px;">
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'cancel', this);">
                                    @csrf
                                    <input type="hidden" name="action" value="cancel">
                                    <button type="submit" style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer; width: 200px;">
                                        <i class="fas fa-times-circle" style="margin-right: 8px;"></i>Cancel Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    button:hover {
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    button:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }

    .swal2-popup.swal2-rounded {
        border-radius: 16px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmStatusChange(currentStatus, action, form) {
        let message = '';
        if (action === 'cancel') {
            message = 'Do you want to cancel this order?';
        } else if (currentStatus === 'Confirmed') {
            message = "Do you want to mark this order as 'Preparing'?";
        } else if (currentStatus === 'Preparing') {
            message = "Do you want to mark this order as 'Waiting for Delivery'?";
        } else if (action === 'confirm') {
            message = "Do you want to confirm this order?";
        }

        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E7592B',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Yes, proceed!',
            customClass: {
                popup: 'swal2-rounded'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

        return false;
    }
</script>
@endpush
