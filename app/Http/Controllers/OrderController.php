<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;
use App\Mail\OrderCancelledMail;
use App\Models\User;



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


    // Handle order confirmation
    public function confirmOrder(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string',
            'Number' => 'required|string',
            'address' => 'required|string',
            'marks' => 'nullable|string',
            'payment_method' => 'required|string', // radio input
        ]);

        // Get cart data
        $cartItems = Cart::with('product')->where('u_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        $subTotal = $cartItems->sum('subtotal');
        $discount = 40;
        $delivery = 100;
        $total = $subTotal - $discount + $delivery;

        if ($request->payment_method === 'cod') {
            // CASH ON DELIVERY

            $order = Order::create([
                'name' => $request->name,
                'phone' => $request->Number,
                'address' => $request->address,
                'landmark' => $request->marks,
                'total' => $total,
                'u_id' => Auth::id(),
                'payment_status' => 'Cash on Delivery',
                'order_status' => 'Ordered',
            ]);

            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name ?? 'Unknown',
                    'size'=>  $item->size,
                    'quantity' => $item->quantity,
                    'extra_toppings' => $item->extra_toppings ?? 'N/A',
                ]);
            }

            // Send mail
            $user = Auth::user();
                try {
                                Mail::to($user->email)->send(new OrderPlacedMail($order));
                            } catch (\Exception $e) {
                                \Log::error('Mail Error: ' . $e->getMessage());
                            }



            Cart::where('u_id', Auth::id())->delete();

            



            return redirect()->route('ordersuccess')->with('success', 'Order placed with Cash on Delivery!');
        }

        // STRIPE PAYMENT

        // Store order info in session temporarily
        session([
            'checkout_name' => $request->name,
            'checkout_phone' => $request->Number,
            'checkout_address' => $request->address,
            'checkout_landmark' => $request->marks,
            'checkout_total' => $total,
        ]);

        // Create Stripe Checkout Session
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripeSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => 'Order from Pizza Shop',
                    ],
                    'unit_amount' => $total * 100, 
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('checkout'),
        ]);

        return redirect($stripeSession->url);
    }

    // Stripe success callback
    public function stripeSuccess()
    {
        $cartItems = Cart::with('product')->where('u_id', Auth::id())->get();
        $total = session('checkout_total');

        $order = Order::create([
            'name' => session('checkout_name'),
            'phone' => session('checkout_phone'),
            'address' => session('checkout_address'),
            'landmark' => session('checkout_landmark'),
            'total' => $total,
            'u_id' => Auth::id(),
            'payment_status' => 'Paid',
            'order_status' => 'Ordered',
        ]);

        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name ?? 'Unknown',
                'size'=>  $item->size,
                'quantity' => $item->quantity,
                'extra_toppings' => $item->extra_toppings ?? 'N/A',
            ]);
        }

        // Send mail
            $user = Auth::user();
                try {
                                Mail::to($user->email)->send(new OrderPlacedMail($order));
                            } catch (\Exception $e) {
                                \Log::error('Mail Error: ' . $e->getMessage());
                            }

        Cart::where('u_id', Auth::id())->delete();

       

        return redirect()->route('ordersuccess')->with('success', 'Payment successful! Order confirmed.');
    }

    public function userOrders()
    {
        $orders = Order::where('u_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('CustomerOrders.orderTrack', compact('orders'));
    }


    public function getOrderDetails($id)
{
    $order = Order::where('id', $id)->where('u_id', Auth::id())->firstOrFail();
    $items = OrderDetail::where('order_id', $order->id)->get(['product_name', 'quantity', 'extra_toppings','size']);

    return response()->json([
        'order_status' => $order->order_status,
        'items' => $items
    ]);
}


        public function cancelOrder($id)
        {
            $order = Order::where('id', $id)->where('u_id', Auth::id())->firstOrFail();

            if ($order->order_status === 'Confirmed' || $order->order_status === 'Ordered' ) {
                $order->order_status = 'Cancelled';
                $order->save();

                // Send mail
                $user = Auth::user();
                try {
                    Mail::to($user->email)->send(new OrderCancelledMail($order));
                } catch (\Exception $e) {
                    \Log::error('Cancel Mail Error: ' . $e->getMessage());
                }
            }

            

            return back();
        }
  public function paymentcomplete()
        {
            
            return view('CustomerOrders.paymentsucce');
}



}