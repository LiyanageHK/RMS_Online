@extends('layouts.app')

@section('title', 'Item Details: ' . $item->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">
                        <i class="fas fa-box-open mr-2"></i> Item Details: {{ $item->name }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.inventory.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Inventory
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Item Information Card -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-info-circle mr-2"></i>Basic Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4">Category:</dt>
                                        <dd class="col-sm-8">{{ $item->category_name }}</dd>

                                        <dt class="col-sm-4">Description:</dt>
                                        <dd class="col-sm-8">{{ $item->description ?? 'N/A' }}</dd>

                                        <dt class="col-sm-4">Unit Price:</dt>
                                        <dd class="col-sm-8">Rs. {{ number_format($item->price, 2) }}</dd>

                                        <dt class="col-sm-4">Alert Level:</dt>
                                        <dd class="col-sm-8">{{ $item->alert_level }}</dd>

                                        <dt class="col-sm-4">Current Stock:</dt>
                                        <dd class="col-sm-8">
                                            <span class="badge badge-{{ $currentStock <= $item->alert_level ? 'danger' : 'success' }} p-2">
                                                {{ $currentStock }}
                                                @if($currentStock <= $item->alert_level)
                                                    <i class="fas fa-exclamation-circle ml-1"></i>
                                                @endif
                                            </span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Summary Card -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-chart-pie mr-2"></i>Stock Summary
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-4 border-right">
                                            <div class="text-muted">Total Received</div>
                                            <h3 class="text-success">{{ $grnHistory->sum('quantity') }}</h3>
                                        </div>
                                        <div class="col-4 border-right">
                                            <div class="text-muted">Total Used</div>
                                            <h3 class="text-danger">{{ $orderHistory->sum('item_quantity') }}</h3>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-muted">Current Stock</div>
                                            <h3 class="{{ $currentStock <= $item->alert_level ? 'text-danger' : 'text-primary' }}">
                                                {{ $currentStock }}
                                            </h3>
                                        </div>
                                    </div>
                                    <hr>
                                   <div class="text-center">
    @if($currentStock <= $item->alert_level)
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reorderModal-{{ $item->id }}">
            <i class="fas fa-shopping-cart mr-1"></i> Reorder Item
        </button>
        
        <!-- Reorder Modal -->
        <div class="modal fade" id="reorderModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="reorderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="reorderModalLabel">Low Stock Notification</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.inventory.send-low-stock-alert', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Item Details</label>
                                <input type="text" class="form-control" value="{{ $item->name }} (Current Stock: {{ $currentStock }}, Alert Level: {{ $item->alert_level }})" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>Select Admins to Notify</label>
                                @foreach($admins as $admin)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="recipients[]" value="{{ $admin->email }}" id="admin-{{ $admin->id }}-{{ $item->id }}" checked>
                                        <label class="form-check-label" for="admin-{{ $admin->id }}-{{ $item->id }}">
                                            {{ $admin->name }} ({{ $admin->position }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="form-group">
                                <label>Additional Message (Optional)</label>
                                <textarea name="additional_message" class="form-control" rows="3" placeholder="Add any special instructions..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-paper-plane mr-1"></i> Send Notification
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <span class="text-success">
            <i class="fas fa-check-circle mr-1"></i> Stock level is acceptable
        </span>
    @endif
</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction History -->
                    <div class="row">
                        <!-- GRN History -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-arrow-down mr-2"></i>Receiving History
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>GRN Reference</th>
                                                    <th class="text-right">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($grnHistory as $grn)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($grn->grn_date)->format('M d, Y') }}</td>
                                                    <td>{{ $grn->reference ?? 'N/A' }}</td>
                                                    <td class="text-right text-success">+{{ $grn->quantity }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-3">No receiving history found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order History -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-arrow-up mr-2"></i>Usage History
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Order #</th>
                                                    <th class="text-right">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($orderHistory as $order)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</td>
                                                    <td>#{{ $order->order_id }}</td>
                                                    <td class="text-right text-danger">-{{ $order->item_quantity }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-3">No usage history found</td>
                                                </tr>
                                                @endforelse
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
    </div>
</div>
@endsection