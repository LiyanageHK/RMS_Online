@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded p-6">
<div style="padding: 20px;">
    <h2>Customer Overview</h2>

    @if (session('success'))
        <div style="color: green; margin: 10px 0;">{{ session('success') }}</div>
    @endif

    <br>

    <a href="{{ route('customer.create') }}" style="padding: 8px 14px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">Add New Customer</a>




    <!-- Search bar -->
<div style="margin: 20px 0; text-align: right;">
    <form method="GET" action="{{ route('customer.overview') }}" style="display: inline-block;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search here..."
               style="padding: 8px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" style="padding: 8px 14px; background-color: #007bff; color: white; border: none; border-radius: 4px;">Search</button>
    </form>
</div>


    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f4f4f4;">
            <tr>
                <th>Customer ID</th>
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

                        <!-- View Button -->
                        <a href="{{ route('customer.show', $user->user_id) }}"
                        style="margin-right: 8px; padding: 6px 12px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center;">
                            <span class="material-icons" style="font-size: 16px; margin-right: 4px;">visibility</span>View
                        </a>

                        <!-- Edit Button -->
                        <a href="{{ route('customer.edit', $user->user_id) }}"
                        style="margin-right: 8px; padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center;">
                            <span class="material-icons" style="font-size: 16px; margin-right: 4px;">edit</span>Edit
                        </a>


                        <!-- Delete Button -->
<form id="deleteForm-{{ $user->user_id }}" action="{{ route('customer.destroy', $user->user_id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="button"
            onclick="showDeleteModal({{ $user->user_id }}, '{{ $user->name }}')"
            style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; display: inline-flex; align-items: center;">
        <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span>Delete
    </button>
</form>
                    </td>




                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>



    <!-- Custom Confirmation Modal -->
<div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
    <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
        <div style="margin-bottom: 15px;">
            <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
        </div>
        <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
        <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this customer?</p>
        <div style="display: flex; justify-content: center; gap: 15px;">
            <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
            <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;
    function showDeleteModal(id, name) {
        formToSubmit = document.getElementById('deleteForm-' + id);
        document.getElementById('modalMessage').textContent = `Are you sure you want to delete "${name}"?`;
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



    <style>
    a {
    text-decoration: none;
}
<style>
    .container {
        max-width: 90vw;
        padding: 1rem;
    }

    .table-auto {
        border-collapse: collapse;
        width: 100%;
        font-size: 0.95rem;
        border-radius: 0.375rem;
        overflow: hidden;
    }

    .table-auto th,
    .table-auto td {
        padding: 14px 12px;
        border: 1px solid #e5e7eb; /* Tailwind gray-200 */
        text-align: center;
    }

    .table-auto th {
        background-color: #f3f4f6; /* Tailwind gray-100 */
        font-weight: 600;
        text-transform: uppercase;
    }

    .table-auto tr:hover {
        background-color: #f9fafb; /* Tailwind gray-50 */
    }

    #searchInput {
        padding: 10px 14px;
        transition: border 0.3s, box-shadow 0.3s;
    }

    #searchInput:focus {
        border-color: #3b82f6; /* blue-500 */
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3); /* blue-300 ring */
    }

    h2, h3, h4 {
        margin-bottom: 0.75rem;
    }
</style>


@endsection
