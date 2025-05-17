<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Mail\LowStockAlert;
use Illuminate\Support\Facades\Mail;


class InventoryController extends Controller
{
    public function index()
    {
        // Get all inventory items from the view
        $inventory = DB::table('live_inventory')
            ->orderBy('category_name')
            ->orderBy('item_name')
            ->get();

        return view('admin.inventory.index', compact('inventory'));
    }

    public function show($id)
    {
        // Get item details from the items table
        $item = DB::table('items')
            ->join('item_categories', 'items.category_id', '=', 'item_categories.id')
            ->where('items.id', $id)
            ->select('items.*', 'item_categories.name as category_name')
            ->first();

        if (!$item) {
            return redirect()->route('admin.inventory.index')
                ->with('error', 'Item not found');
        }

         $admins = DB::table('employees')
        ->where('position', 'admin')
        ->get();

        // Get current stock from the view
        $currentStock = DB::table('live_inventory')
            ->where('item_id', $id)
            ->value('on_hand_quantity');

        // Get GRN history (still need raw query as view doesn't track individual transactions)
        $grnHistory = DB::table('grn_items')
            ->join('grns', 'grn_items.grn_id', '=', 'grns.id')
            ->where('grn_items.item_id', $id)
            ->select('grn_items.*', 'grns.created_at as grn_date')
            ->orderBy('grns.created_at', 'desc')
            ->get();

        // Get order history (still need raw query)
        $orderHistory = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('product_items', 'order_details.product_id', '=', 'product_items.product_id')
            ->where('product_items.item_id', $id)
            ->where('orders.order_status', '!=', 'Cancelled')
            ->select(
                'order_details.*',
                'orders.created_at as order_date',
                DB::raw('(order_details.quantity * product_items.quantity) as item_quantity')
            )
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('admin.inventory.show', compact(
            'item',
            'grnHistory',
            'orderHistory',
            'currentStock',
              'admins'
        ));
    }

public function lowStock()
{
    \Log::info('lowStock method called');

    $lowStock = DB::table('live_inventory')
        ->whereColumn('on_hand_quantity', '<=', 'alert_level')
        ->orWhere('on_hand_quantity', '<=', 0)
        ->orderBy('on_hand_quantity')
        ->get();

    \Log::debug('Low stock items:', ['count' => $lowStock->count(), 'items' => $lowStock]);

    $admins = Employee::where('position', 'admin')->get();

    \Log::debug('Admin users:', ['count' => $admins->count(), 'admins' => $admins]);

    return view('admin.inventory.low-stock', compact('lowStock', 'admins'));
}

    // In InventoryController.php

public function sendLowStockAlert(Request $request, $itemId)
{
    $item = DB::table('items')->find($itemId);
    
    if (!$item) {
        return back()->with('error', 'Item not found');
    }

    $request->validate([
        'recipients' => 'required|array',
        'recipients.*' => 'email',
        'additional_message' => 'nullable|string'
    ]);

    $admins = DB::table('employees')
        ->where('position', 'admin')
        ->whereIn('email', $request->recipients)
        ->get();

    if ($admins->isEmpty()) {
        return back()->with('error', 'No valid admin recipients selected');
    }

    $currentStock = DB::table('live_inventory')
        ->where('item_id', $itemId)
        ->value('on_hand_quantity');

    foreach ($admins as $admin) {
        Mail::to($admin->email)->send(new LowStockAlert(
            $item,
            $currentStock,
            $admin,
            $request->additional_message
        ));
    }

    return back()->with('success', 'Low stock notifications sent successfully');
}
    public function updateAlertLevel(Request $request, $id)
    {
        $request->validate([
            'alert_level' => 'required|integer|min:0'
        ]);

        DB::table('items')
            ->where('id', $id)
            ->update(['alert_level' => $request->alert_level]);

        return back()->with('success', 'Alert level updated successfully');
    }
}