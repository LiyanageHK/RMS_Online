@extends('layouts.app')

@section('content')
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 20px; margin: 0; font-weight: 500;">Overview</h2>
        <input type="text" id="searchInput" placeholder="Search products..." 
               style="padding: 10px 12px; width: 260px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 20px 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 30px 30px;">
        
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 18px; color: #333;">Products</h3>
            <a href="{{ url('admin/production/create') }}"
               style="padding: 8px 14px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 6px; font-size: 14px; transition: background-color 0.3s;">
                + New Product
            </a>
        </div>

        <!-- Products Table -->
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px;">
            <thead style="background-color: #f9f9f9;">
                <tr>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Image</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Name</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Status</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Created At</th>
                    <th style="padding: 12px; text-align: right; font-weight: 600;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <td style="padding: 12px;">
                            @if($p->thumbnail)
                                <a href="{{ asset('uploads/products/' . $p->thumbnail) }}" target="_blank" onclick="event.preventDefault(); openImagePopup('{{ asset('uploads/products/' . $p->thumbnail) }}');">
                                    <img src="{{ asset('uploads/products/' . $p->thumbnail) }}" 
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #eee;">
                                </a>
                            @else
                                <span style="color: #999;">No Image</span>
                            @endif
                        </td>
                        <td style="padding: 12px;">{{ $p->name }}</td>
                        <td style="padding: 12px;">
                            <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500; 
                                      background-color: {{ $p->status ? '#d4edda' : '#e2e3e5' }};
                                      color: {{ $p->status ? '#155724' : '#383d41' }};">
                                {{ $p->status ? 'For Sale' : 'Not for Sale' }}
                            </span>
                        </td>
                        <td style="padding: 12px;">{{ \Carbon\Carbon::parse($p->created_at)->format('Y-m-d') }}</td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ url('admin/production/edit/' . $p->id) }}" 
                               style="display: inline-block; background-color: #0d6efd; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ url('admin/production/delete/' . $p->id) }}" 
                               onclick="return confirm('Are you sure you want to delete this product?')"
                               style="display: inline-block; background-color: #dc3545; color: white; text-decoration: none; padding: 6px 12px; border-radius: 5px; font-size: 14px; margin-left: 5px;">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; color: #666;">No products found.</td>
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
            for (let j = 1; j < cells.length - 1; j++) { // Skip image and actions columns
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

function openImagePopup(imageUrl) {
    const popupOverlay = document.createElement('div');
    popupOverlay.style.position = 'fixed';
    popupOverlay.style.top = '0';
    popupOverlay.style.left = '0';
    popupOverlay.style.width = '100%';
    popupOverlay.style.height = '100%';
    popupOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
    popupOverlay.style.zIndex = '1000';
    popupOverlay.style.display = 'flex';
    popupOverlay.style.justifyContent = 'center';
    popupOverlay.style.alignItems = 'center';

    const popupImage = document.createElement('img');
    popupImage.src = imageUrl;
    popupImage.style.maxWidth = '90%';
    popupImage.style.maxHeight = '90%';
    popupImage.style.border = '2px solid white';
    popupImage.style.borderRadius = '8px';

    popupOverlay.appendChild(popupImage);

    popupOverlay.addEventListener('click', () => {
        document.body.removeChild(popupOverlay);
    });

    document.body.appendChild(popupOverlay);
}
</script>
@endsection
