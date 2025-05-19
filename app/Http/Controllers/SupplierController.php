<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%')
                  ->orWhere('contact_person_name', 'like', '%' . $search . '%');
            });
        }

        $suppliers = $query->orderBy('id')->get();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Vegetables,Meat,Seafood',
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:suppliers,email',
            ],
            'phone' => ['required', 'regex:/^\+94[0-9]{9}$/'],
            'address' => 'required|string|max:500',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_phone' => ['nullable', 'regex:/^\+94[0-9]{9}$/'],
            'contact_person_email' => [
                'nullable',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
        ]);

        try {
            // Convert category id to category name before storing
            $categoryId = $request->input('category');
            $categoryName = \DB::table('item_categories')->where('id', $categoryId)->value('name');
            $data = $request->all();
            $data['category'] = $categoryName;
            Supplier::create($data);
            return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Debugging only — remove in production
        }
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $categories = \DB::table('item_categories')->pluck('name', 'id');
        return view('suppliers.edit', compact('supplier', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $categoryIds = \DB::table('item_categories')->pluck('id')->toArray();

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => ['required', 'in:' . implode(',', $categoryIds)],
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:suppliers,email,' . $supplier->id,
            ],
            'phone' => ['required', 'regex:/^\+94[0-9]{9}$/'],
            'address' => 'required|string|max:500',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_phone' => ['nullable', 'regex:/^\+94[0-9]{9}$/'],
            'contact_person_email' => [
                'nullable',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
        ]);

        // Convert category id to category name before updating
        $categoryId = $request->input('category');
        $categoryName = \DB::table('item_categories')->where('id', $categoryId)->value('name');
        $data = $request->all();
        $data['category'] = $categoryName;
        $supplier->update($data);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        // Check all POs for this supplier
        $purchaseOrders = $supplier->purchaseOrders()->get();
        $hasDraftPO = $purchaseOrders->where('status', 'Draft')->count() > 0;
        $hasSentPO = $purchaseOrders->where('status', 'Sent')->count() > 0;
        $hasReceivedPO = $purchaseOrders->where('status', 'Received')->count() > 0;
        $hasGRN = $supplier->grns()->exists();

        if ($hasSentPO) {
            return redirect()->route('suppliers.index')->with('error', 'This supplier is linked to a Sent Purchase Order. You cannot delete this supplier.');
        }
        if ($hasReceivedPO) {
            return redirect()->route('suppliers.index')->with('error', 'This supplier is linked to a Received Purchase Order. Please delete the PO(s) first before deleting the supplier.');
        }
        if ($hasDraftPO) {
            return redirect()->route('suppliers.index')->with('error', 'This supplier is linked to a Draft Purchase Order. Please edit or delete the PO(s) first before deleting the supplier.');
        }
        // Only show confirmation if supplier is linked to a GRN and NOT to any PO at all
        if ($hasGRN && !$hasDraftPO && !$hasSentPO && !$hasReceivedPO && $purchaseOrders->count() == 0 && !$request->input('confirmed')) {
            return redirect()->route('suppliers.index')->with('error', 'This supplier is linked to a GRN. Are you sure you want to delete?')->with('confirm_supplier_delete', $supplier->id);
        }

        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
