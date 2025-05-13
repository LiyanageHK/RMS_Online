@extends('layouts.app')

@section('content')
    <div class="allocation-container">
        <h2>Driver List</h2>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($drivers->isEmpty())
            <p>No drivers found.</p>
        @else
            <table class="driver-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Postal Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivers as $driver)
                        <tr>
                            <td>{{ $driver->id }}</td>
                            <td>{{ $driver->name }}</td>
                            <td>{{ $driver->nic }}</td>
                            <td>{{ $driver->email }}</td>
                            <td>{{ $driver->phone }}</td>
                            <td>{{ $driver->address_line1 }} {{ $driver->address_line2 }}</td>
                            <td>{{ $driver->city }}</td>
                            <td>{{ $driver->postal_code }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>



    <div class="container">
    <h2>Drivers Currently on Ride</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(isset($driversOnRide) && $driversOnRide->count() > 0)
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Driver Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Assigned Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($driversOnRide as $driver)
                    <tr>
                        <td>{{ $driver->assigned_to }}</td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->address }}</td>
                        <td>{{ \Carbon\Carbon::parse($driver->created_at)->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No drivers are currently on ride.</p>
    @endif
</div>








@endsection



<style>
    .allocation-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .alert.success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    .alert.error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }

    .driver-table {
        width: 100%;
        border-collapse: collapse;
    }

    .driver-table th, .driver-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .driver-table th {
        background-color: #7e848a;
        color: white;
    }

    .driver-table tr:hover {
        background-color: #f1f1f1;
    }
</style>

