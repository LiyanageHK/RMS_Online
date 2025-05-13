{{-- resources/views/profile_orderdetails.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History - Flame & Crust</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>


<a href="{{ route('profile') }}">Edit Profile</a>
<a href="{{ route('profile.orders') }}">View Order History</a>


<div class="order-history-section container">
    <div class="order-header">
        <h2>Order History for {{ $user->name }}</h2>
        <a href="{{ route('menu') }}" class="btn-order">Place New Order</a>
        <a href="{{ route('profile.edit') }}" class="btn">Back to Profile</a>
    </div>

    <table class="order-table">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Items</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>#{{ $order->order_number }}</td>
                    <td>{{ implode(', ', $order->items->pluck('name')->toArray()) }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">You have no previous orders.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>



</body>
</html>
