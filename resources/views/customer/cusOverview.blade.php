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






<!-- Custom Confirmation Modal -->
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
        <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
            <div style="margin-bottom: 15px;">
                <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
            </div>
            <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
            <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this employee?</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
            </div>
        </div>
    </div>

    <!-- Modal Script -->
    <script>
        let formToSubmit = null;

        function showDeleteModal(id, name) {
            formToSubmit = document.getElementById('deleteForm-' + id);
            document.getElementById('modalMessage').textContent = Are you sure you want to delete "${name}"?;
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





</div>


@endsection
