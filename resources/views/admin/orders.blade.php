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
<div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 25px 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 40px 30px;">
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
                <option value="Ordered" {{ request('order_status') == 'Ordered' ? 'selected' : '' }}>Ordered</option>
                <option value="Confirmed" {{ request('order_status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Preparing" {{ request('order_status') == 'Preparing' ? 'selected' : '' }}>Preparing</option>
                <option value="Waiting for Delivery" {{ request('order_status') == 'Waiting for Delivery' ? 'selected' : '' }}>Waiting for Delivery</option>
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
            <button type="submit" 
                    style="background-color: #28a745; color: white; padding: 6px 10px; border: none; border-radius: 4px; font-size: 13px; display: inline-flex; align-items: center; cursor: pointer;">
                <span class="material-icons" style="font-size: 16px; margin-right: 4px;">picture_as_pdf</span> Download All as PDF
            </button>
        </form>

        <form  method="POST" action="{{ url('admin/orders/delete-all')}}" onsubmit="return confirm('Are you sure to delete ALL orders?')">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" style="background-color: #dc3545; color: white; padding: 6px 10px; border: none; border-radius: 4px; font-size: 13px; display: inline-flex; align-items: center; cursor: pointer;">
                                    <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span> Delete All Orders
                                </button>
                            </form>
    </div>

  <!-- Orders Table -->
  <div class="table-responsive">
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
            <thead style="background-color: #f9f9f9;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-weight: 600;"></th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Name</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Address</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Phone</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Total</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Payment</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Status</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Details</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;"></th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;"></th>
                </tr>
            </thead>
            <tbody>
                @php $totalAmount = 0; @endphp
                @forelse($orders as $index => $order)
                    @php $totalAmount += $order->total; @endphp
                    <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px;">{{ $order->name }}</td>
                        <td style="padding: 12px;">{{ $order->address }}</td>
                        <td style="padding: 12px;">{{ $order->phone }}</td>
                        <td style="padding: 12px;">LKR {{ number_format($order->total, 2) }}</td>
                        <td style="padding: 12px;">{{ $order->payment_status }}</td>
                        <td style="padding: 12px;">{{ $order->order_status }}</td>
                        <td style="padding: 12px;">
                            @foreach($order->details as $detail)
                                {{ $detail->product_name }} x{{ $detail->quantity }} ({{ $detail->extra_toppings }})<br>
                            @endforeach
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ url('admin/orders/download/' . $order->id) }}" 
                              style="margin-right: 8px; background-color: #28a745; color: white; padding: 6px 10px; border-radius: 4px; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center;">
                                <span class="material-icons" style="font-size: 16px; margin-right: 4px;">picture_as_pdf</span> PDF
                            </a>
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <form id="deleteForm-{{ $order->id }}" method="POST" action="{{ url('admin/orders/delete/' . $order->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" data-name="{{ $order->customer_name ?? 'Order #' . $order->id }}" onclick="showDeleteModal({{ $order->id }})" style="background-color: #dc3545; color: white; padding: 6px 10px; border: none; border-radius: 4px; font-size: 13px; display: inline-flex; align-items: center; cursor: pointer;">
                                    <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span> Delete
                                </button>
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
                    <th colspan="6">LKR {{ number_format($totalAmount, 2) }}</th>
                </tr>
            </tfoot>
    </table>
  </div>
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
<!-- Delete Confirmation Modal -->
<div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
  <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
    <div style="margin-bottom: 15px;">
      <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
    </div>
    <h4 class="mb-2">Confirm Deletion</h4>
    <p id="modalMessage">Are you sure you want to delete this?</p>
    <div class="d-flex justify-content-center gap-3">
      <button id="cancelBtn" class="btn btn-secondary">Cancel</button>
      <button id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
    </div>
  </div>
</div>

<script>
let formToSubmit = null;

function showDeleteModal(id) {
  formToSubmit = document.getElementById('deleteForm-' + id);
  document.getElementById('modalMessage').textContent = `Are you sure you want to delete order #${id}?`;
  document.getElementById('confirmModal').style.display = 'flex';
}

document.getElementById('cancelBtn').addEventListener('click', function () {
  document.getElementById('confirmModal').style.display = 'none';
  formToSubmit = null;
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
  if (formToSubmit) formToSubmit.submit();
});
</script>

</body>
</html>
  @endsection