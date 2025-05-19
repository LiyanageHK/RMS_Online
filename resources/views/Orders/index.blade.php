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

        <div style="max-height: 450px; overflow-y: auto; width: 100%;">
            <table style="width: 100%; margin-top: 10px; border-collapse: collapse;">
                <thead style="background: #f9f9f9; position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th style="padding: 10px; text-align: left; background: #f9f9f9;">Order Number</th>
                        <th style="padding: 10px; text-align: left; background: #f9f9f9;">Customer</th>
                        <th style="padding: 10px; text-align: left; background: #f9f9f9;">Status</th>
                        <th style="padding: 10px; text-align: left; background: #f9f9f9;">Actions</th>
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
                                <!-- Confirm Order -->
@if($order->order_status === 'Ordered')
    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'confirm', this);">
        @csrf
        <input type="hidden" name="action" value="confirm">
        <button type="submit" style="padding: 10px 20px; background-color: #808080; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; width: 200px;">
            <i class="fas fa-check-circle" style="margin-right: 8px;"></i>Confirm Order
        </button>
    </form>
@elseif($order->order_status === 'Confirmed')
    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'advance', this);">
        @csrf
        <button type="submit" style="padding: 10px 20px; background-color: #808080; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; width: 200px;">
            <i class="fas fa-utensils" style="margin-right: 8px;"></i>Start Preparation
        </button>
    </form>
@elseif($order->order_status === 'Preparing')
    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'advance', this);">
        @csrf
        <button type="submit" style="padding: 10px 20px; background-color: #808080; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; width: 200px;">
            <i class="fas fa-truck" style="margin-right: 8px;"></i>Ready for Delivery
        </button>
    </form>
@endif
    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" onsubmit="return confirmStatusChange('{{ $order->order_status }}', 'cancel', this);">
        @csrf
        <input type="hidden" name="action" value="cancel">
        <button type="submit" style="padding: 10px 20px; background-color: #DC3545; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; width: 200px;">
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

    <div id="orderStatusModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
        <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
            <div style="margin-bottom: 15px;">
                <span class="material-icons" style="font-size: 40px; color: #E7592B;">help_outline</span>
            </div>
            <h4 id="orderStatusModalTitle" style="margin-bottom: 10px; font-size: 18px; color: #333;">Are you sure?</h4>
            <p id="orderStatusModalMsg" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to perform this action?</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button id="cancelOrderStatusBtn" type="button" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                <button id="confirmOrderStatusBtn" type="button" style="padding: 10px 20px; background-color: #E7592B; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Yes, proceed!</button>
            </div>
        </div>
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

    /* Custom modal styles */
    #orderStatusModal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    #orderStatusModal .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        width: 400px;
        max-width: 90%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        text-align: center;
    }

    #orderStatusModal h4 {
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    #orderStatusModal p {
        font-size: 15px;
        margin-bottom: 25px;
    }

    #orderStatusModal button {
        padding: 10px 20px;
        border: none;
        color: #fff;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
    }

    #orderStatusModal #confirmOrderStatusBtn {
        background-color: #E7592B;
    }

    #orderStatusModal #cancelOrderStatusBtn {
        background-color: #6c757d;
    }
</style>
@endpush

@push('scripts')
<script>
    // Custom modal confirmation for order status changes
    let pendingOrderStatusForm = null;
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
        } else {
            message = 'Are you sure you want to perform this action?';
        }
        document.getElementById('orderStatusModalMsg').textContent = message;
        document.getElementById('orderStatusModal').style.display = 'flex';
        pendingOrderStatusForm = form;
        return false;
    }
    document.getElementById('confirmOrderStatusBtn').onclick = function() {
        document.getElementById('orderStatusModal').style.display = 'none';
        if (pendingOrderStatusForm) {
            pendingOrderStatusForm.submit();
            pendingOrderStatusForm = null;
        }
    };
    document.getElementById('cancelOrderStatusBtn').onclick = function() {
        document.getElementById('orderStatusModal').style.display = 'none';
        pendingOrderStatusForm = null;
    };
</script>
@endpush
