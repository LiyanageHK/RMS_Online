@component('mail::message')
# Hello {{ $order->name }},

You have successfully **canceled** your order.

**Order ID:** {{ $order->id }}  
**Total Amount:** Rs. {{ number_format($order->total, 2) }}  
**Payment Method:** {{ $order->payment_status }}  
**Delivery Address:** {{ $order->address }}

@component('mail::panel')
If any payment was made, it will be refunded according to our refund policy.
@endcomponent

We hope to serve you again soon. If you have any questions or need assistance, feel free to reach out.

Thank you for visiting us!

Regards,  
**FLAME & CRUST PIZZERIA**
@endcomponent

