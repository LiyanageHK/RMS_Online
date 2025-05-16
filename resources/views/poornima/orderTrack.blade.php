@extends('layouts.appclient')

@section('content')
<br><br><br>
<div class="container mt-5">
    <h2 class="mb-4">My Orders</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($orders as $order)
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                    <p class="card-text mb-1"><strong>Total:</strong> Rs. {{ number_format($order->total, 2) }}</p>
                    <p class="card-text mb-1"><strong>Status:</strong> <span class="badge bg-success">{{ $order->payment_status }}</span></p>
                    <p class="card-text"><strong>Date:</strong> {{ $order->created_at }}</p>
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#orderDetails{{ $order->id }}" onclick="loadOrderDetails({{ $order->id }})">
                        View Details
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="orderDetails{{ $order->id }}">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Order #{{ $order->id }} Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div id="order-items-{{ $order->id }}">
                    Loading...
                </div>

                <h6 class="mt-3">Status: <span class="badge bg-info text-dark" id="status-label-{{ $order->id }}"></span></h6>
                <div class="progress mb-3" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="status-bar-{{ $order->id }}" style="width: 0%;">
                    </div>
                </div>

                <form method="POST" id="cancel-form-{{ $order->id }}" action="/cancel-order/{{ $order->id }}" style="display: none;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger w-100">Cancel Order</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
<br><br>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function loadOrderDetails(orderId) {
        fetch(`/order-details/${orderId}`)
            .then(response => response.json())
            .then(data => {
                let itemsHtml = '';
                data.items.forEach(item => {
                    itemsHtml += `<li class="list-group-item">${item.size} ${item.product_name} ${item.extra_toppings !== 'N/A' ? 'with extra toppings' : ''} × ${item.quantity}</li>`;
                });

                document.getElementById('order-items-' + orderId).innerHTML = `<ul class="list-group mb-3">${itemsHtml}</ul>`;
                document.getElementById('status-label-' + orderId).innerText = data.order_status;

                const progressMap = {
                    'Ordered': 0,
                    'Confirmed': 20,
                    'Preparing': 40,
                    'Waiting for Delivery': 60,
                    'Dispatched ': 80,
                    'Delivered': 100
                };
                document.getElementById('status-bar-' + orderId).style.width = progressMap[data.order_status] + '%';
                document.getElementById('status-bar-' + orderId).innerText = data.order_status;

                if (data.order_status === 'Confirmed' || data.order_status === 'Ordered') {
                    document.getElementById('cancel-form-' + orderId).style.display = 'block';
                } else {
                    document.getElementById('cancel-form-' + orderId).style.display = 'none';
                }
            });
    }
</script>
@endsection
