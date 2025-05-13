@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Customer List</h2>

        @if($customers->count())
            <form method="POST" action="#">
                @csrf

                <table class="table-auto w-full mt-4 border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">Select</th>
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr class="text-center">
                                <td class="border px-4 py-2">
                                    <input type="checkbox" name="user_ids[]" value="{{ $customer->user_id }}">
                                </td>
                                <td class="border px-4 py-2">
                                    {{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}
                                </td>
                                <td class="border px-4 py-2">{{ $customer->name }}</td>
                                <td class="border px-4 py-2">{{ $customer->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $customers->links() }}
                </div>
            </form>
        @else
            <p class="text-gray-600 mt-4">No customers found.</p>
        @endif
    </div>
</div>

<!-- Optional Custom Styles -->
<style>
    .container {
        max-width: 1200px;
    }

    .table-auto {
        width: 100%;
        border-collapse: collapse;
    }

    .table-auto th,
    .table-auto td {
        padding: 12px;
        border: 1px solid #e0e0e0;
        text-align: left;
    }

    .table-auto th {
        background-color: #f1f1f1;
        font-weight: bold;
    }

    .table-auto tr:hover {
        background-color: #f9fafb;
    }

    .text-gray-600 {
        color: #718096;
    }
</style>
@endsection
