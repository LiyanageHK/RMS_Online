<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        // Get all items with their current inventory status
        $inventory = DB::table('items')
            ->leftJoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->select(
                'items.id',
                'items.name as item_name',
                'item_categories.name as category_name',
                'items.price',
                'items.description',
                DB::raw('COALESCE(grn.received_qty, 0) as total_received'),
                DB::raw('COALESCE(orders.ordered_qty, 0) as total_ordered'),
                DB::raw('COALESCE(grn.received_qty, 0) - COALESCE(orders.ordered_qty, 0) as current_stock')
            )
            ->leftJoin(DB::raw('(SELECT item_id, SUM(received_qty) as received_qty 
                                FROM grn_items 
                                GROUP BY item_id) as grn'), 
                      'items.id', '=', 'grn.item_id')
            ->leftJoin(DB::raw('(SELECT item_id, SUM(quantity) as ordered_qty 
                                FROM order_details 
                                JOIN orders ON order_details.order_id = orders.id 
                                WHERE orders.order_status = "Completed" 
                                GROUP BY item_id) as orders'), 
                      'items.id', '=', 'orders.item_id')
            ->orderBy('item_categories.name')
            ->orderBy('items.name')
            ->get();

        return view('admin.inventory.index', compact('inventory'));
    }

    public function show($id)
    {
        // Get detailed inventory history for a specific item
        $item = DB::table('items')
            ->join('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->where('items.id', $id)
            ->select('items.*', 'item_categories.name as category_name')
            ->first();

        if (!$item) {
            return redirect()->route('admin.inventory.index')
                ->with('error', 'Item not found');
        }

        // Get GRN history
        $grnHistory = DB::table('grn_items')
            ->join('grn', 'grn_items.grn_id', '=', 'grn.id')
            ->where('grn_items.item_id', $id)
            ->select('grn_items.*', 'grn.created_at as grn_date')
            ->orderBy('grn.created_at', 'desc')
            ->get();

        // Get order history
        $orderHistory = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('order_details.item_id', $id)
            ->where('orders.order_status', 'Completed')
            ->select('order_details.*', 'orders.created_at as order_date')
            ->orderBy('orders.created_at', 'desc')
            ->get();

        // Calculate current stock
        $totalReceived = $grnHistory->sum('received_qty');
        $totalOrdered = $orderHistory->sum('quantity');
        $currentStock = $totalReceived - $totalOrdered;

        return view('admin.inventory.show', compact('item', 'grnHistory', 'orderHistory', 'currentStock'));
    }

    public function lowStock()
    {
        // Get items with low stock (less than 10)
        $lowStock = DB::table('items')
            ->leftJoin('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->select(
                'items.id',
                'items.name as item_name',
                'item_categories.name as category_name',
                'items.price',
                DB::raw('COALESCE(grn.received_qty, 0) as total_received'),
                DB::raw('COALESCE(orders.ordered_qty, 0) as total_ordered'),
                DB::raw('COALESCE(grn.received_qty, 0) - COALESCE(orders.ordered_qty, 0) as current_stock')
            )
            ->leftJoin(DB::raw('(SELECT item_id, SUM(received_qty) as received_qty 
                                FROM grn_items 
                                GROUP BY item_id) as grn'), 
                      'items.id', '=', 'grn.item_id')
            ->leftJoin(DB::raw('(SELECT item_id, SUM(quantity) as ordered_qty 
                                FROM order_details 
                                JOIN orders ON order_details.order_id = orders.id 
                                WHERE orders.order_status = "Completed" 
                                GROUP BY item_id) as orders'), 
                      'items.id', '=', 'orders.item_id')
            ->having('current_stock', '<', 10)
            ->orderBy('current_stock')
            ->get();

        return view('admin.inventory.low-stock', compact('lowStock'));
    }
} 