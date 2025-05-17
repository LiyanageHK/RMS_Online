<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    // Show orders with status confirmed or preparing
    public function index(Request $request)
{
    $query = OrderStatus::query();

    if ($request->filled('order_number')) {
        $query->where('id', $request->order_number);
    }

    if ($request->filled('status')) {
        $query->where('order_status', $request->status);
    } else {
        // default filter
        $query->whereIn('order_status', ['Ordered','Confirmed', 'Preparing']);
    }

    $orders = $query->get();

    return view('orders.index', compact('orders'));
}


    // Update the status of an order
    public function updateStatus(Request $request, OrderStatus $order)
{
    if ($request->action === 'cancel') {
        // Allow canceling from any state
        $order->order_status = 'Cancelled';

    } elseif ($order->order_status === 'Ordered' && $request->action === 'confirm') {
        $order->order_status = 'Confirmed';

    } elseif ($order->order_status === 'Confirmed') {
        $order->order_status = 'Preparing';

    } elseif ($order->order_status === 'Preparing') {
        $order->order_status = 'Waiting for Delivery';
    }

    $order->save();

    return redirect()->back();
}

}
