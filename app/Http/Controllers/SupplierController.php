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
        // Fetch categories from item categories table
        $categories = \DB::table('item_categories')->pluck('name', 'id');
        return view('suppliers.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $categoryIds = \DB::table('item_categories')->pluck('id')->toArray();
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => ['required', 'in:' . implode(',', $categoryIds)],
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
            Supplier::create($request->all());
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
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Vegetables,Meat,Seafood',
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

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
