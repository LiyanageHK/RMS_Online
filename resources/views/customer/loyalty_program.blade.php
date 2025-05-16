@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Loyalty Program</h2>

        <div class="mt-8 mb-4">
            <h4 class="text-lg font-semibold">Loyalty Program Levels:</h4>
            <ul class="list-disc list-inside text-gray-600 mt-2">
                <li><strong>Silver:</strong> 3–4 Orders</li>
                <li><strong>Gold:</strong> 5–9 Orders</li>
                <li><strong>Platinum:</strong> 10+ Orders</li>
            </ul>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Loyalty Customer Details</h3>

            <!-- Search -->
            <div class="mb-4">
                <label for="searchInput" class="block text-gray-700 font-medium mb-2">Search Here:</label>
                <input
                    type="text"
                    id="searchInput"
                    onkeyup="filterTable()"
                    placeholder="Type to search..."
                    class="w-full pl-4 pr-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                >
            </div>

            @if($loyalCustomers->count())
                <table class="table-auto w-full mt-4 border" id="customersTable">
                    <thead>
                        <tr class="bg-gray-100 text-center">
                            <th class="px-4 py-2 border">Customer Number</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Phone</th>
                            <th class="px-4 py-2 border">Loyalty Level</th>
                            <th class="px-4 py-2 border">Number of Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loyalCustomers as $customer)
                            <tr class="text-center">
                                <td class="border px-4 py-2">CUS#{{ str_pad($customer->user_id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="border px-4 py-2">{{ $customer->name }}</td>
                                <td class="border px-4 py-2">{{ $customer->email }}</td>
                                <td class="border px-4 py-2">{{ $customer->phone }}</td>
                                <td class="border px-4 py-2 font-semibold">{{ $customer->loyalty_level }}</td>
                                <td class="border px-4 py-2">{{ $customer->orders_count ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600 mt-4">No loyalty customers found.</p>
            @endif
        </div>
    </div>
</div>

<!-- JavaScript filter -->
<script>
    function filterTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#customersTable tbody tr");
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>

<style>
    .container {
        max-width: 1200px;
    }
    .table-auto th,
    .table-auto td {
        padding: 12px;
        border: 1px solid #e0e0e0;
        text-align: center;
    }
    .table-auto th {
        background-color: #f1f1f1;
    }
    .table-auto tr:hover {
        background-color: #f9fafb;
    }
</style>
@endsection
