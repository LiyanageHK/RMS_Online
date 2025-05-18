<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseOrderSent;

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


        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->whereIn('status', ['Draft', 'Sent', 'Received']);
        }

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
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->supplier_id = $request->supplier_id;
        $purchaseOrder->order_date = $request->order_date;
        $purchaseOrder->delivery_date = $request->delivery_date;
        $purchaseOrder->total_amount = str_replace(['$', ','], '', $request->total_amount);
;


        if (in_array($request->action, ['send', 'send'])) {
            $purchaseOrder->status = 'Sent'; 

        } else {
            $purchaseOrder->status = 'Draft'; // Draft when 'Save as Draft' button clicked
        }

        $purchaseOrder->save();


        if (is_array($request->items)) {
            foreach ($request->items as $itemId => $itemData) {
                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'item_id' => $itemId,
                    'quantity' => (float) $itemData['quantity'],
                    'price' => (float) $itemData['price'],
                    'total' => $itemData['quantity'] * $itemData['price'],
                ]);
            }
        }

        if ($request->action === 'send') {
            $purchaseOrder->load(['supplier', 'items.item']);
            Mail::to($purchaseOrder->supplier->email)->send(new PurchaseOrderSent($purchaseOrder));

        }

        return redirect()->route('purchase_orders.index')->with('success', 'Purchase Order saved successfully');
    }

    public function update(Request $request, $id)

    {
        $po = PurchaseOrder::findOrFail($id);
        $po->supplier_id = $request->supplier_id;
        $po->delivery_date = $request->delivery_date;
        $po->total_amount = $request->filled('total_amount') 
            ? (float) str_replace(['$', ','], '', $request->total_amount) 
            : 0;

        $po->status = in_array($request->action, ['send', 'send']) ? 'Sent' : 'Draft';
        $po->save();

        PurchaseOrderItem::where('purchase_order_id', $po->id)->delete();

        if (is_array($request->items)) {
            foreach ($request->items as $itemId => $itemData) {
                PurchaseOrderItem::create([
                    'purchase_order_id' => $po->id,
                    'item_id' => $itemId,
                    'quantity' => (float) $itemData['quantity'],
                    'price' => (float) $itemData['price'],
                    'total' => $itemData['quantity'] * $itemData['price'],
                ]);
            }
        }

        if ($request->action === 'send') {
            $po->load(['supplier', 'items.item']);
            \Mail::to($po->supplier->email)->send(new \App\Mail\PurchaseOrderSent($po));
        }

        return redirect()->route('purchase_orders.index')->with('success', 'Purchase Order updated successfully.');
    }

    public function getPOData($id)
    {
        $po = PurchaseOrder::with(['supplier', 'items.item'])->findOrFail($id);

        return response()->json([
            'supplier_id' => $po->supplier_id,
            'supplier_name' => $po->supplier->name,
            'items' => $po->items->map(function ($item) {
                return [
                    'id' => $item->item_id,
                    'name' => $item->item->name ?? 'Unknown',
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ];
            }),

        ]);
      
    }

    
}

