@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Item Details: {{ $item->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Inventory
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Item Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Category:</th>
                                    <td>{{ $item->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $item->description }}</td>
                                </tr>
                                <tr>
                                    <th>Price:</th>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Current Stock:</th>
                                    <td>
                                        <span class="badge badge-{{ $currentStock < 10 ? 'danger' : 'success' }}">
                                            {{ $currentStock }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h4>GRN History</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Quantity Received</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grnHistory as $grn)
                                        <tr>
                                            <td>{{ $grn->grn_date }}</td>
                                            <td>{{ $grn->received_qty }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4>Order History</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Quantity Ordered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderHistory as $order)
                                        <tr>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->quantity }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 