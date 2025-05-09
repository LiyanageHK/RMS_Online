<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Items;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function create()
    {
        $suppliers = Supplier::all();
        $items = Items::all();
        return view('PurchaseOrders.POcreate', compact('suppliers', 'items'));
    }

    public function index(Request $request)
{
    $search = $request->input('search');

    $query = PurchaseOrder::with('supplier');

    if ($search) {
        $query->whereHas('supplier', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        })->orWhere('id', 'like', "%{$search}%");
    }

    $purchaseOrders = $query->latest()->get();

    return view('PurchaseOrders.POindex', compact('purchaseOrders'));
}


    public function show($id)
    {
        $po = PurchaseOrder::with(['supplier', 'items.item'])->findOrFail($id);
        return view('PurchaseOrders.show', compact('po'));
    }

    public function edit($id)
    {
        $po = PurchaseOrder::with('items')->findOrFail($id);  // Fetch the purchase order with items
        $suppliers = Supplier::all();  // Fetch all suppliers for the dropdown
        $items = Items::all();  // Fetch all items for the dropdown
        return view('PurchaseOrders.edit', compact('po', 'suppliers', 'items'));  // Pass the data to the view
    }

public function destroy($id)
{
    $po = PurchaseOrder::findOrFail($id);
    $po->delete();

    return redirect()->route('purchase_orders.index')->with('success', 'Purchase Order deleted successfully.');
}

    public function store(Request $request)
    {
        // Store Purchase Order
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->supplier_id = $request->supplier_id;
        $purchaseOrder->order_date = $request->order_date;
        $purchaseOrder->delivery_date = $request->delivery_date;
        $purchaseOrder->total_amount = str_replace(['$', ','], '', $request->total_amount);
;

        if ($request->action == 'send') {
            $purchaseOrder->status = 'Sent'; // Mark as sent when 'Send' button clicked
        } else {
            $purchaseOrder->status = 'Draft'; // Draft when 'Save as Draft' button clicked
        }

        $purchaseOrder->save();

        // Store the items in the pivot table (many-to-many)
        foreach ($request->items as $itemId => $itemData) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $purchaseOrder->id,
                'item_id' => $itemId,
                'quantity' => $itemData['quantity'],
                'price' => $itemData['price'],
                'total' => $itemData['quantity'] * $itemData['price'],
            ]);
        }

        return redirect()->route('purchase_orders.index')->with('success', 'Purchase Order saved successfully');
    }

    public function update(Request $request, $id)
{
    $po = PurchaseOrder::findOrFail($id);
    $po->supplier_id = $request->supplier_id;
    $po->delivery_date = $request->delivery_date;
    $po->total_amount = str_replace(['$', ','], '', $request->total_amount);

    $po->status = $request->action === 'send' ? 'Sent' : 'Draft';
    $po->save();

    // Delete existing items first to avoid duplicates
    PurchaseOrderItem::where('purchase_order_id', $po->id)->delete();

    // Re-insert updated items
    foreach ($request->items as $itemId => $itemData) {
        PurchaseOrderItem::create([
            'purchase_order_id' => $po->id,
            'item_id' => $itemId,
            'quantity' => $itemData['quantity'],
            'price' => $itemData['price'],
            'total' => $itemData['quantity'] * $itemData['price'],
        ]);
    }

    return redirect()->route('purchase_orders.index')->with('success', 'Purchase Order updated successfully.');
}
}
