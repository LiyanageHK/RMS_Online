@extends('layouts.app')

@section('title', 'Inventory')

@section('content')
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 20px; margin: 0; font-weight: 500;">Overview</h2>
        <input type="text" id="searchInput" placeholder="Search inventory..." 
               style="padding: 10px 12px; width: 260px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 20px 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 30px 30px;">
        
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 18px; color: #333;">Inventory Status</h3>
            
        </div>

        <!-- Inventory Table -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
            <thead style="background-color: #f9f9f9;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Category</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Item Name</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Price (Rs.)</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Total Received</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Total Ordered</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Current Stock</th>
                    <th style="padding: 12px; text-align: right;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventory as $item)
                    <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <td style="padding: 12px;">{{ $item->category_name }}</td>
                        <td style="padding: 12px;">{{ $item->item_name }}</td>
                        <td style="padding: 12px;">Rs. {{ number_format($item->price, 2) }}</td>
                        <td style="padding: 12px;">{{ $item->total_received }}</td>
                        <td style="padding: 12px;">{{ $item->total_ordered }}</td>
                        <td style="padding: 12px;">
                            <span style="display: inline-block; padding: 4px 8px; border-radius: 4px; 
                                  background-color: {{ $item->current_stock < 10 ? '#dc3545' : '#28a745' }}; 
                                  color: white; font-size: 12px;">
                                {{ $item->current_stock }}
                            </span>
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ route('admin.inventory.show', $item->id) }}" 
                               style="display: inline-block; background-color: #6c757d; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 12px; text-align: center;">No inventory items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.querySelector('table');
    const rows = table.getElementsByTagName('tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = searchInput.value.toLowerCase();

        // Start from 1 to skip header row
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName('td');
            let found = false;

            // Search through each cell in the row
            for (let j = 0; j < cells.length - 1; j++) { // Skip last column (actions)
                const cellText = cells[j].textContent.toLowerCase();
                if (cellText.includes(searchTerm)) {
                    found = true;
                    break;
                }
            }

            // Show/hide row based on search
            row.style.display = found ? '' : 'none';
        }
    });

    // Add fade out for alert
    const alert = document.querySelector('.alert-dismissible');
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.15s ease-in-out';
            setTimeout(() => alert.remove(), 150);
        }, 3000);
    }
});
</script>
@endsection 