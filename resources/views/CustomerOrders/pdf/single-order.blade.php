<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }
        .company-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-header h1 {
            margin: 0;
            color: #2c3e50;
        }
        .order-info, .order-details {
            width: 100%;
            margin-bottom: 20px;
        }
        .order-info th, .order-info td {
            text-align: left;
            padding: 5px 0;
        }
        .order-details th {
            background-color: #f4f4f4;
        }
        .order-details th, .order-details td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 40px;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="company-header">
        <h1>FLAME & CRUST PIZZERIA</h1>
        <p>Report</p>
    </div>

    <table class="order-info">
        <tr>
            <th>Order ID:</th>
            <td>#{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Date:</th>
            <td>{{ $order->created_at->format('F d, Y h:i A') }}</td>
        </tr>
        <tr>
            <th>Customer:</th>
            <td>{{ $order->name }}</td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td>{{ $order->phone }}</td>
        </tr>
        <tr>
            <th>Address:</th>
            <td>{{ $order->address }}</td>
        </tr>
        <tr>
            <th>Landmark:</th>
            <td>{{ $order->landmark ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Payment Status:</th>
            <td>{{ $order->payment_status }}</td>
        </tr>
        <tr>
            <th>Order Status:</th>
            <td>{{ $order->order_status }}</td>
        </tr>
    </table>

    <h3>Order Items</h3>
    <table class="order-details">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Toppings</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->extra_toppings }}</td>
                    <td>{{ $detail->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: <strong>${{ number_format($order->total, 2) }}</strong></p>

    <div class="footer">
        <p>Generated on {{ now()->format('F d, Y h:i A') }}</p>
    </div>

</body>
</html>
