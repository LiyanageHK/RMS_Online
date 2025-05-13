@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Low Stock Items</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Inventory
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Total Received</th>
                                    <th>Total Ordered</th>
                                    <th>Current Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStock as $item)
                                <tr>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->total_received }}</td>
                                    <td>{{ $item->total_ordered }}</td>
                                    <td>
                                        <span class="badge badge-danger">
                                            {{ $item->current_stock }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.inventory.show', $item->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                    </td>
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
@endsection 