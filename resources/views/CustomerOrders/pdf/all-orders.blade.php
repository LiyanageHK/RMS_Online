<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Filtered Orders Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.6;
            color: #333;
        }

        .header, .footer {
            text-align: center;
            margin: 20px 0;
        }

        .header h1 {
            margin: 0;
            color: #2c3e50;
        }

        .order-section {
            margin-bottom: 30px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .order-section h3 {
            margin-bottom: 5px;
            color: #3498db;
        }

        .order-meta {
            margin-bottom: 10px;
        }

        .order-meta p {
            margin: 2px 0;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.items th, table.items td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        table.items th {
            background-color: #f2f2f2;
        }

        .total-summary {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
            font-size: 15px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .footer {
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>FLAME & CRUST PIZZERIA</h1>
        <p>Orders Report</p>
    </div>

    @php $totalSum = 0; @endphp

    @foreach($orders as $order)
        @php $totalSum += $order->total; @endphp
        <div class="order-section">
            <h3>Order #{{ $order->id }}</h3>
            <div class="order-meta">
                <p><strong>Customer:</strong> {{ $order->name }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
            </div>

            <table class="items">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Toppings</th>
                        <th>Qty</th>
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
        </div>
    @endforeach

    <div class="total-summary">
        Total of All Orders: ${{ number_format($totalSum, 2) }}
    </div>

    <div class="footer">
        <p>Generated on {{ now()->format('F d, Y h:i A') }}</p>
    </div>

    

</body>
</html>
