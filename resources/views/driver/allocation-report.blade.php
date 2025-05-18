<!DOCTYPE html>
<html>
<head>
    <title>FLAME & CRUST PIZZARIA - Driver Allocation Report</title>
    <style>
        /* Use a clean, readable font */
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #fff;
        }
        header {
            text-align: center;
            border-bottom: 3px solid #E63946;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        header h1 {
            margin: 0;
            font-size: 28px;
            color: #E63946; /* Flame red */
            letter-spacing: 2px;
        }
        header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
            font-style: italic;
        }
        h2 {
            text-align: center;
            color: #1D3557; /* Dark blue */
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #F4A261; /* Warm orange */
            color: #fff;
            text-align: left;
            font-weight: 600;
        }
        td {
            background-color: #FFF8F0;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>FLAME & CRUST PIZZARIA</h1>
        <p>Driver Allocation Report</p>
    </header>

    <h2>Order Details</h2>

    <table>
        <tr>
            <th>Order ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Driver Name</th>
            <td>{{ $driver->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Delivery Address</th>
            <td>{{ $delivery->address ?? $order->address ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Landmark</th>
            <td>{{ $delivery->landmark ?? 'Not specified' }}</td>
        </tr>
        <tr>
            <th>Contact Phone</th>
            <td>{{ $delivery->phone ?? $order->phone ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Order Total</th>
            <td>${{ number_format($order->total ?? 0, 2) }}</td>
        </tr>
        <tr>
            <th>Allocation Date</th>
            <td>{{ now()->toDayDateTimeString() }}</td>
        </tr>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} FLAME & CRUST PIZZARIA — Delivering Freshness to Your Doorstep
    </div>
</body>
</html>
