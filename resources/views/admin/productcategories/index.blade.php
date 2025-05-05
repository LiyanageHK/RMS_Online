@extends('layouts.app')

@section('content')
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 20px; margin: 0; font-weight: 500;">Overview</h2>
        <input type="text" id="searchInput" placeholder="Search product categories..." 
               style="padding: 10px 12px; width: 260px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 20px 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 30px 30px;">
        
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 18px; color: #333;">Product Categories</h3>
            <a href="{{ url('admin/productcategories/create') }}"
               style="padding: 8px 14px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 6px; font-size: 14px; transition: background-color 0.3s;">
                + Add New Category
            </a>
        </div>

        <!-- Categories Table -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
            <thead style="background-color: #f9f9f9;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">ID</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Name</th>
                    <th style="padding: 12px; text-align: right;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <td style="padding: 12px;">{{ $cat->id }}</td>
                        <td style="padding: 12px;">{{ $cat->name }}</td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ url('admin/productcategories/edit/'.$cat->id) }}" 
                               style="display: inline-block; background-color: #0d6efd; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ url('admin/productcategories/delete/'.$cat->id) }}" 
                               onclick="return confirm('Are you sure you want to delete this category?')"
                               style="display: inline-block; background-color: #dc3545; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 12px; text-align: center;">No product categories found.</td>
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
