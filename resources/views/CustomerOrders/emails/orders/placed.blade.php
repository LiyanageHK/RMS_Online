@component('mail::message')
# Thank you for your order, {{ $order->name }}!

We have received your order and it is now confirmed.

**Order ID:** {{ $order->id }}  
**Total Amount:** Rs. {{ number_format($order->total, 2) }}  
**Payment Method:** {{ $order->payment_status }}  
**Delivery Address:** {{ $order->address }}

@component('mail::panel')
We'll notify you when your order is out for delivery.
@endcomponent

Thanks again for choosing us!

Regards,  
**FLAME & CRUST PIZZERIA**
@endcomponent
