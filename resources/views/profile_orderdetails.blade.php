{{-- resources/views/profile_orderdetails.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders - Flame & Crust</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">



    <style>
        .order-history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 6px;
            overflow: hidden;
        }

        .order-history-table th,
        .order-history-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .order-history-table th {
            background-color: #f5f5f5;
            font-weight: 600;
            color: #333;
        }

        .order-history-table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .order-history-table tbody tr:hover {
            background-color: #f0f8ff;
            transition: background-color 0.3s ease;
        }

        .order-history-table td {
            color: #555;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ff5722;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e64a19;
        }
    </style>



</head>
<body>

@include('partials.header')

<div class="container">
    <h2>Your Order History</h2>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        <table class="order-history-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Address</th>
                    <th>Landmark</th>
                    <th>Phone</th>
                    <th>Total (LKR)</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Ordered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->landmark ?? 'N/A' }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ number_format($order->total, 2) }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->order_status }}</td>
                        <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{ url('/profile') }}" class="btn">← Back to Profile</a>
</div>

@include('partials.footer')

</body>
</html>




