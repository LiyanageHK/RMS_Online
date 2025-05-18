<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Method to handle the Customer Center page
    public function customerCenter()
    {
        return view('customer_center')->with('section', 'customer');
    }

    // Method to handle the Delivery page
    public function deliveryCenter()
    {
        return view('delivery_center')->with('section', 'delivery');
    }
}
