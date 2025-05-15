@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    .order-table thead {
      background-color: #343a40;
      color: #fff;
    }
    .filter-bar {
      background: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .table-wrapper {
      overflow-x: auto;
    }
  </style>
</head>
<body>
<div class="container mt-5">

  <h2 class="mb-4">Orders Management</h2>

  <!-- Filter Section -->
  <form method="GET" action="{{ url('admin/orders') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label>Payment Status</label>
            <select name="payment_status" class="form-select">
                <option value="">All</option>
                <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                <option value="Cash on Delivery" {{ request('payment_status') == 'Cash on Delivery' ? 'selected' : '' }}>Cash on Delivery</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Order Status</label>
            <select name="order_status" class="form-select">
                <option value="">All</option>
                <option value="Confirmed" {{ request('order_status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Preparing" {{ request('order_status') == 'Preparing' ? 'selected' : '' }}>Preparing</option>
                <option value="Prepared" {{ request('order_status') == 'Prepared' ? 'selected' : '' }}>Prepared</option>
                <option value="Delivering" {{ request('order_status') == 'Delivering' ? 'selected' : '' }}>Delivering</option>
                <option value="Delivered" {{ request('order_status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="Cancelled" {{ request('order_status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>From</label>
            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>
        <div class="col-md-3">
            <label>To</label>
            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>
        <div class="col-12 d-flex justify-content-end mt-3">
            <button class="btn btn-primary me-2">Filter</button>
            <a href="{{ url('admin/orders') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

  <!-- Actions -->
  <div class="mb-3 d-flex justify-content-between">
        <form method="GET" action="{{ url('admin/orders/download-all') }}">
            
            <input type="hidden" name="payment_status" value="{{ request('payment_status') }}">
            <input type="hidden" name="order_status" value="{{ request('order_status') }}">
            <input type="hidden" name="from_date" value="{{ request('from_date') }}">
            <input type="hidden" name="to_date" value="{{ request('to_date') }}">
            <button type="submit" class="btn btn-outline-success">Download All as PDF</button>
        </form>

        <form method="POST" action="{{ url('admin/orders/delete-all') }}" onsubmit="return confirm('Are you sure to delete ALL orders?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Delete All</button>
        </form>
    </div>

  <!-- Orders Table -->
  <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>PDF</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @php $totalAmount = 0; @endphp
                @forelse($orders as $index => $order)
                    @php $totalAmount += $order->total; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->order_status }}</td>
                        <td>
                            @foreach($order->details as $detail)
                                {{ $detail->product_name }} x{{ $detail->quantity }} ({{ $detail->extra_toppings }})<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ url('admin/orders/download/' . $order->id) }}" class="btn btn-sm btn-outline-primary">PDF</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ url('admin/orders/delete/' . $order->id) }}" onsubmit="return confirm('Delete this order?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <th colspan="4">Total of All Orders:</th>
                    <th colspan="6">${{ number_format($totalAmount, 2) }}</th>
                </tr>
            </tfoot>
    </table>
  </div>

</div>

<hr>
<h3 style="text-align: center;">Order Statistics Summary</h3>

<!-- Pie Chart: Cancelled vs Other Orders -->
<div style="margin-top: 30px; text-align: center;">
    <h5>Cancelled Orders vs Other Orders</h5>
    <img src="https://quickchart.io/chart?c={type:'pie',data:{labels:['Cancelled','Other'],datasets:[{data:[{{ $cancelledCount }},{{ $otherCount }}]}]}}" width="600">
    <br>
   
</div><br><br>


<!-- Static Image: Monthly Demand Chart -->
@php
  $chartLabels = implode("','", $labels);
  $chartData = implode(",", $monthlyOrders); 
@endphp

<div style="margin-top: 40px; text-align: center;">
    <h5>Order Demand Over Time</h5>
    <img src="https://quickchart.io/chart?c={type:'line',data:{labels:['{{ $chartLabels }}'],datasets:[{label:'Orders',data:[{{ $chartData }}],borderColor:'blue',fill:false}]}}" width="500">
    <br>
    
</div>




</body>
</html>
  @endsection