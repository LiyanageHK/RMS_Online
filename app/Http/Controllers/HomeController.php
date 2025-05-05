<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $status = session('status');

        // Get counts from database
        $totalItems = DB::selectOne("SELECT COUNT(*) as count FROM items")->count;
        $totalProducts = DB::selectOne("SELECT COUNT(*) as count FROM products")->count;
        $activeProducts = DB::selectOne("SELECT COUNT(*) as count FROM products WHERE status = 1")->count;
        $totalCategories = DB::selectOne("SELECT COUNT(*) as count FROM item_categories")->count;

        // Get monthly sales data for chart
        $monthlySales = DB::select("
            SELECT 
                DATE_FORMAT(created_at, '%b') as month,
                COUNT(*) as count
            FROM products 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY DATE_FORMAT(created_at, '%b')
            ORDER BY created_at ASC
        ");

        // Get product status distribution
        $productStatus = DB::select("
            SELECT 
                status,
                COUNT(*) as count
            FROM products
            GROUP BY status
        ");

        return view('home', compact(
            'status',
            'totalItems',
            'totalProducts',
            'activeProducts',
            'totalCategories',
            'monthlySales',
            'productStatus'
        ));
    }

    
}
