@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Loyalty Program</h2>



         <div class="mt-8">
            <h4 class="text-lg font-semibold">Loyalty Program Terms:</h4>
            <ul class="list-disc list-inside text-gray-600 mt-2">
                <li>A customer becomes a loyalty member after making more than 3 purchases.</li>
                <li>  Loyalty members receive a flat 10% discount on every order.</li>
            </ul>
        </div>


        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Loyalty Customer Details</h3>


            @if($loyalCustomers->count())
    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">Customer Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Number of Orders</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loyalCustomers as $customer)
                <tr class="text-center">
                    <td class="border px-4 py-2">{{ $customer->name }}</td>
                    <td class="border px-4 py-2">{{ $customer->email }}</td>
                    <td class="border px-4 py-2">{{ $customer->orders_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-gray-600 mt-4">No loyalty customers found yet.</p>
@endif



        </div>


    </div>
</div>





<!-- Custom CSS -->
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

    .bg-gray-100 {
        background-color: #f7fafc;
    }

    .bg-gray-50 {
        background-color: #f9fafb;
    }

    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }

    .text-gray-800 {
        color: #2d3748;
    }

    .text-gray-600 {
        color: #718096;
    }

    .font-semibold {
        font-weight: 600;
    }
</style>





@endsection
