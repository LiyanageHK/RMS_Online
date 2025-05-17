@extends('layouts.admin')

@section('content')
<div style="padding: 30px; background-color: #f5f5f5;">
    <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">Orders</h2>

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
                        @if($order->order_status === 'Confirmed' || $order->order_status === 'Preparing')
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display: inline;" onsubmit="return confirmStatusChange('{{ $order->order_status }}', this);">
                                @csrf
                                @if($order->order_status === 'Confirmed')
                                    <button type="submit" style="padding: 10px 20px; background-color: #cccccc; color: black; min-width: 165px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                        <i class="fas fa-cogs" style="margin-right: 8px;"></i>Start Preparation
                                    </button>
                                @elseif($order->order_status === 'Preparing')
                                    <button type="submit" style="padding: 10px 20px; background-color: #E7592B; color: white; min-width: 165px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                        <i class="fas fa-truck" style="margin-right: 8px;"></i>Ready for Delivery
                                    </button>
                                @endif
                            </form>
                        @else
                            <span style="color: gray;">No further action</span>
                        @endif
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
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmStatusChange(currentStatus, form) {
        let nextStatus = '';
        if (currentStatus === 'Confirmed') {
            nextStatus = 'Preparing';
        } else if (currentStatus === 'Preparing') {
            nextStatus = 'Waiting for Delivery';
        }

        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to mark this order as '${nextStatus}'?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E7592B',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Yes, change it!',
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
