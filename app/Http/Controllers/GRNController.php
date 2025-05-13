<?php

namespace App\Http\Controllers;
use App\Models\GRN;
use App\Models\GRNItem;
use App\Models\Items;
use App\Models\Supplier;
use App\Models\PurchaseOrder;


use Illuminate\Http\Request;

class GRNController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $grns = \App\Models\GRN::with('supplier', 'items')
        ->when($search, function ($query, $search) {
            $query->whereHas('supplier', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('id', ltrim($search, '0')); // support GRN#00001
        })
        ->latest()
        ->get();

    return view('GRN.index', compact('grns'));
}



    public function create()
{
    $suppliers = Supplier::all();
    $items = Items::all();
    $purchaseOrders = PurchaseOrder::all();
    return view('GRN.create', compact('suppliers','items','purchaseOrders'));
}

public function store(Request $request)
{
    $request->validate([
        'grn_date' => 'required|date',
        'supplier_id' => 'required|exists:suppliers,id',
        'items.*.item_id' => 'required|exists:items,id',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    // Start calculating total
    $totalAmount = 0;

    // Create the GRN first
    $grn = GRN::create([
        'grn_date' => $request->grn_date,
        'reference' => $request->reference_number,
        'supplier_id' => $request->supplier_id,
    ]);

    foreach ($request->items as $grnItem) {
        $item = Items::find($grnItem['item_id']);

        if ($item) {
            $lineTotal = $item->price * $grnItem['quantity'];
            $totalAmount += $lineTotal;

            // Create the GRN item
            $grn->items()->create([
                'item_id' => $item->id,
                'quantity' => $grnItem['quantity'],
            ]);
        }
    }

    // Update total amount
    $grn->total_amount = $totalAmount;
    $grn->save();

    return redirect()->route('grns.index')->with('success', 'GRN created successfully!');
}


public function show($id)
{
    $grn = GRN::with(['supplier', 'items.item'])->findOrFail($id);
    return view('GRN.show', compact('grn'));
}

   
    
    public function destroy(string $id)
    {
        $grn = GRN::findOrFail($id);
        $grn->delete();

        return redirect()->route('grns.index')->with('success', 'GRN deleted successfully.');
    }
}
