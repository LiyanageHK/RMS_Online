@extends('layouts.app')

@section('content')
    <h1>Loyalty Program</h1>

    <style>
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f4f4f4;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .table td {
            font-size: 14px;
        }
    </style>

    <table class="table">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Loyalty Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->loyalty_points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
