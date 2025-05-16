<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show orders with status confirmed or preparing
    public function index()
    {
        $orders = Order::whereIn('order_status', ['Confirmed', 'Preparing'])->get();
        return view('orders.index', compact('orders'));
    }

    // Update the status of an order
    public function updateStatus(Order $order)
    {
        if ($order->order_status === 'Confirmed') {
            $order->order_status = 'Preparing';
        } elseif ($order->order_status === 'Preparing') {
            $order->order_status = 'Waiting for Delivery';
        }

        $order->save();

        return redirect()->back();
    }
}
