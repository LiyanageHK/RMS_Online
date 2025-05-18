@extends('layouts.app')

@section('title', 'Low Stock Alerts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Low Stock Items
                    </h3>
                </div>
                <div class="card-body">
                    <form id="bulkNotifyForm" method="POST" action="{{ route('admin.inventory.send-bulk-low-stock-alert') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Send Alerts To:</label>
                                <select name="employee_id" class="form-control" required>
                                    <option value="">Select Admin</option>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }} ({{ $admin->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-paper-plane mr-1"></i> Send Alerts for Selected Items
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Current Stock</th>
                                        <th>Alert Level</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lowStock as $item)
                                    <tr class="{{ $item->on_hand_quantity <= 0 ? 'table-danger' : '' }}">
                                        <td>
                                            <input type="checkbox" name="item_ids[]" value="{{ $item->item_id }}" class="item-checkbox">
                                        </td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->on_hand_quantity }}</td>
                                        <td>{{ $item->alert_level }}</td>
                                        <td>
                                            <span class="badge badge-danger">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $item->stock_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.inventory.show', $item->item_id) }}" 
                                               class="btn btn-sm btn-info" title="View details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <form method="POST" action="{{ route('admin.inventory.send-low-stock-alert') }}" 
                                                  style="display: inline-block;">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item->item_id }}">
                                                <input type="hidden" name="employee_id" value="{{ $admins->first()->id ?? '' }}">
                                                <button type="submit" class="btn btn-sm btn-warning" title="Send alert">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                                            <h5>No low stock items found!</h5>
                                            <p class="mb-0">All inventory items are above their alert thresholds.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                @if($lowStock->count() > 0)
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-danger">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            {{ $lowStock->count() }} item(s) need attention
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkboxes
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Form submission confirmation
    document.getElementById('bulkNotifyForm').addEventListener('submit', function(e) {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked');
        if (checkedItems.length === 0) {
            e.preventDefault();
            alert('Please select at least one item to notify about');
        }
    });
});
</script>
@endpush