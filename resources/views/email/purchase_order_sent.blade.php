<!DOCTYPE html>
<html>

<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background-color: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #343a40; border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">
            Purchase Order #{{ $po->id }}
        </h2>

        <p><strong>Supplier:</strong> {{ $po->supplier->name }}</p>
        <p><strong>Order Date:</strong> {{ $po->order_date }}</p>
        <p><strong>Delivery Date:</strong> {{ $po->delivery_date }}</p>
        <p><strong>Status:</strong> 
            <span style="color: {{ $po->status === 'Sent' ? '#28a745' : '#ffc107' }};">
                {{ $po->status }}
            </span>
        </p>

        <h3 style="margin-top: 30px; color:rgb(9, 10, 10);">Order Items</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="background-color: #007bff; color: white;">
                    <th style="padding: 10px; text-align: left;">Item</th>
                    <th style="padding: 10px; text-align: right;">Quantity</th>
                    <th style="padding: 10px; text-align: right;">Price</th>
                    <th style="padding: 10px; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($po->items as $item)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 8px;">{{ $item->item->name ?? 'Unknown' }}</td>
                    <td style="padding: 8px; text-align: right;">{{ $item->quantity }}</td>
                    <td style="padding: 8px; text-align: right;">${{ number_format($item->price, 2) }}</td>
                    <td style="padding: 8px; text-align: right;">${{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 20px; font-size: 18px;">
            <strong>Total Amount:</strong> 
            <span style="color: #28a745;">${{ number_format($po->total_amount, 2) }}</span>
        </p>

        <p style="margin-top: 30px; color: #6c757d; font-size: 14px;">
            Thank you for doing business with us!<br>
            <strong>Flame & Crust Pizzeria</strong>
        </p>
    </div>
</body>
</html>
