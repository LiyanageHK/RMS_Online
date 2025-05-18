@extends('layouts.app')

@section('content')
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
                        <a href="{{ route('customer.show', $user->user_id) }}" style="margin-right: 8px; padding: 6px 12px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;"><span class="material-icons" style="font-size: 16px; margin-right: 4px;">visibility</span>View</a>
                        <a href="{{ route('customer.edit', $user->user_id) }}" style="margin-right: 8px; padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;"><span class="material-icons" style="font-size: 16px; margin-right: 4px;">edit</span>Edit</a>
                        <button onclick="confirmDelete({{ $user->user_id }})" style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;"> <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span>Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

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
