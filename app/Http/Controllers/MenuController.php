<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index()
    {
        $categories = DB::table('product_categories')
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();
    
        $products = DB::table('products')
            ->select(
                'products.*',
                'product_categories.name as category_name',
                DB::raw('(SELECT image FROM product_images WHERE product_images.product_id = products.id LIMIT 1) as image')
            )
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->where('products.status', 1)
            ->orderBy('products.name', 'asc')
            ->get();
    
        return view('menu', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
} 