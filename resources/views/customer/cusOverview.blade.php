@extends('layouts.app')

@section('content')
<div style="padding: 20px;">
    <h2>Customer Overview</h2>

    @if (session('success'))
        <div style="color: green; margin: 10px 0;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('customer.create') }}" style="padding: 8px 14px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">Add New Customer</a>

    <!-- Search bar -->
    <form method="GET" action="{{ route('customer.overview') }}" style="margin: 20px 0;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customers..."
               style="padding: 8px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" style="padding: 8px 14px; background-color: #007bff; color: white; border: none; border-radius: 4px;">Search</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f4f4f4;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr style="text-align: center;">
                    <td>{{ 'CUS#' . str_pad($user->user_id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('customer.show', $user->user_id) }}" style="margin-right: 8px; padding: 6px 12px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">View</a>
                        <a href="{{ route('customer.edit', $user->user_id) }}" style="margin-right: 8px; padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Edit</a>
                        <button onclick="confirmDelete({{ $user->user_id }})" style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Hidden delete form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Custom Modal -->
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div style="background: white; width: 300px; margin: 150px auto; padding: 20px; border-radius: 8px; text-align: center;">
            <p style="margin-bottom: 20px;">Are you sure you want to delete this customer?</p>
            <button onclick="submitDelete()" style="background-color: red; color: white; padding: 6px 12px; margin-right: 10px; border: none; border-radius: 4px;">Yes</button>
            <button onclick="closeModal()" style="padding: 6px 12px; border: 1px solid #ccc; border-radius: 4px;">Cancel</button>
        </div>
    </div>

    <script>
        let deleteUrl = '';

        function confirmDelete(id) {
            deleteUrl = `/customer/${id}`;
            document.getElementById('confirmModal').style.display = 'block';
        }

        function submitDelete() {
            const form = document.getElementById('deleteForm');
            form.action = deleteUrl;
            form.submit();
        }

        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
        }
    </script>
</div>


@endsection
