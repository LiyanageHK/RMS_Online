<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\LoyaltyCustomer;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
public function view(Request $request){
        $validatedData= $request->validate([
            
            'pid'     =>'required|integer',
            
            
        ]);
       
        $pid = $validatedData['pid'];
        $product = Product::where('id', $pid)->first();
        $productimage = ProductImage::where('product_id', $pid)->first();
        $price=0;

        return view('CustomerOrders.productdetails',compact('product','productimage'));  
    }



    public function addToCart(Request $request)
{
    $validated = $request->validate([
        'product_id'      => 'required|exists:products,id',
        'size'            => 'required|in:small,medium,large',
        'quantity'        => 'required|integer|min:1',
        'extra_toppings'  => 'nullable|boolean',
        
    ]);

    $product = Product::find($validated['product_id']);
    $sizePriceColumn = $validated['size'] . '_price'; 
    $unitPrice = $product->{$sizePriceColumn};
    $toppingCharge = $request->has('extra_toppings') && $request->extra_toppings ? 150 : 0;
    $subtotal = ($unitPrice * $validated['quantity']) + ($toppingCharge * $validated['quantity']);
    

    Cart::create([
        'product_id'     => $product->id,
        'u_id'           => Auth::id(),
        'size'           => $validated['size'],
        'price'          => $unitPrice,
        'quantity'       => $validated['quantity'],
        'extra_toppings' => $request->has('extra_toppings') && $request->extra_toppings,
        'subtotal'       => $subtotal,
    ]);

    return redirect()->back()->with('success', 'Product added to cart!');
}


public function showCart()
{
   $cartItems = Cart::with('product.image')->where('u_id', Auth::id())->get();
   $loyaltyCustomer = LoyaltyCustomer::where('user_id', Auth::id())->first();
    
    $subTotal = $cartItems->sum('subtotal');
    if ($loyaltyCustomer) {
        switch (strtolower($loyaltyCustomer->loyalty_level)) {
            case 'bronze':
                $discount = $subTotal * 0.05;
                break;
            case 'silver':
                $discount = $subTotal * 0.10;
                break;
            case 'gold':
                $discount = $subTotal * 0.15;
                break;
            default:
                $discount = 0;
        }
    }else{$discount = 0;}
    $delivery = 100;
    $total = $subTotal - $discount + $delivery;

    return view('CustomerOrders.cart', compact('cartItems', 'subTotal', 'discount', 'delivery', 'total'));
}

public function checkout()
{
    $cartItems = Cart::with('product')->where('u_id', Auth::id())->get();
    $loyaltyCustomer = LoyaltyCustomer::where('user_id', Auth::id())->first();
    
    $subTotal = $cartItems->sum('subtotal');
    if ($loyaltyCustomer) {
        switch (strtolower($loyaltyCustomer->loyalty_level)) {
            case 'bronze':
                $discount = $subTotal * 0.05;
                break;
            case 'silver':
                $discount = $subTotal * 0.10;
                break;
            case 'gold':
                $discount = $subTotal * 0.15;
                break;
            default:
                $discount = 0;
        }
    }else{$discount = 0;}
    $delivery = 100;
    $total = $subTotal - $discount + $delivery;

    return view('CustomerOrders.checkout', compact('cartItems', 'subTotal', 'discount', 'delivery', 'total'));
}

public function removeItem($id)
{
    $item = Cart::where('id', $id)->where('u_id', Auth::id())->firstOrFail();
    $item->delete();

    return redirect()->back()->with('success', 'Item removed from cart.');
}

public function updateQuantity(Request $request)
{
    $cartItem = Cart::findOrFail($request->id);
    $cartItem->quantity = $request->quantity;
    if ($cartItem->extra_toppings == 1) {
        $top = 150;
    } else {
        $top = 0;
    }
    $cartItem->subtotal = ($cartItem->price * $request->quantity)+($top * $request->quantity);
    $cartItem->save();

    // Return updated subtotal and total
    $cartItems = Cart::where('u_id', auth()->id())->get();
    $loyaltyCustomer = LoyaltyCustomer::where('user_id', Auth::id())->first();
    $subTotal = $cartItems->sum('subtotal');
    
    if ($loyaltyCustomer) {
        switch (strtolower($loyaltyCustomer->loyalty_level)) {
            case 'bronze':
                $discount = $subTotal * 0.05;
                break;
            case 'silver':
                $discount = $subTotal * 0.10;
                break;
            case 'gold':
                $discount = $subTotal * 0.15;
                break;
            default:
                $discount = 0;
        }
    }else{$discount = 0;}
    $delivery = 100; // Static or based on area
    $total = $subTotal - $discount + $delivery;

    return response()->json([
        'itemSubtotal' => number_format($cartItem->subtotal, 2),
        'subTotal' => number_format($subTotal, 2),
        'discount' => number_format($discount, 2),
        'total' => number_format($total, 2),
    ]);
}



}
