<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    public function index()
    {
        $products = DB::select("
            SELECT products.*, 
               (SELECT image FROM product_images WHERE product_images.product_id = products.id LIMIT 1) as thumbnail 
            FROM products
        ");

        return view('admin.production.index', compact('products'));
    }

    public function create()
    {
        $items = DB::select("SELECT * FROM items");
        $categories = DB::select("SELECT * FROM product_categories");
        return view('admin.production.create', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'small' => 'required|numeric|min:0.5',
            'medium' => 'required|numeric|min:0.5',
            'large' => 'required|numeric|min:0.5',
            'small_price' => 'required|numeric|min:0',
            'medium_price' => 'required|numeric|min:0',
            'large_price' => 'required|numeric|min:0',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'item_ids' => 'required|array|min:1',
            'item_ids.*' => 'exists:items,id',
          
        ], [
            'item_ids.required' => 'Please select at least one item',
            'item_ids.min' => 'Please select at least one item',
         
        ]);

        // Insert product
        DB::insert("INSERT INTO products (name, description, category_id, status, small, medium, large, small_price, medium_price, large_price, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $request->name,
            $request->description,
            $request->category_id,
            $request->status ? 1 : 0,
            $request->small,
            $request->medium,
            $request->large,
            $request->small_price,
            $request->medium_price,
            $request->large_price,
        ]);

        $productId = DB::getPdo()->lastInsertId();

        // Insert items & quantities
        foreach ($request->item_ids as $index => $itemId) {
            $quantity = $request->quantities[$index];
            DB::insert("INSERT INTO product_items (product_id, item_id, quantity, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
                $productId, $itemId, $quantity
            ]);
        }

        // Insert images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $filename);

                DB::insert("INSERT INTO product_images (product_id, image, created_at) VALUES (?, ?, NOW())", [
                    $productId, $filename
                ]);
            }
        }

        return redirect('/admin/production')->with('success', 'Product Created!');
    }

    public function edit($id)
    {
        $product = DB::selectOne("SELECT * FROM products WHERE id = ?", [$id]);
        $items = DB::select("SELECT * FROM items");
        $categories = DB::select("SELECT * FROM product_categories");
        $productItems = DB::select("SELECT * FROM product_items WHERE product_id = ?", [$id]);
        $images = DB::select("SELECT * FROM product_images WHERE product_id = ?", [$id]);

        $selected = [];
        foreach ($productItems as $pi) {
            $selected[$pi->item_id] = $pi->quantity;
        }

        return view('admin.production.edit', compact('product', 'items', 'categories', 'selected', 'images'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'small' => 'required|numeric|min:0.5',
            'medium' => 'required|numeric|min:0.5',
            'large' => 'required|numeric|min:0.5',
            'small_price' => 'required|numeric|min:0',
            'medium_price' => 'required|numeric|min:0',
            'large_price' => 'required|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'item_ids' => 'required|array|min:1',
            'item_ids.*' => 'exists:items,id',
            
        ], [
            'item_ids.required' => 'Please select at least one item',
            'item_ids.min' => 'Please select at least one item',
           
        ]);

        // Update product
        DB::update("UPDATE products SET name = ?, description = ?, status = ?, small = ?, medium = ?, large = ?, small_price = ?, medium_price = ?, large_price = ?, category_id = ?, updated_at = NOW() WHERE id = ?", [
            $request->name,
            $request->description,
            $request->status ? 1 : 0,
            $request->small,
            $request->medium,
            $request->large,
            $request->small_price,
            $request->medium_price,
            $request->large_price,
            $request->category_id,
            $id
        ]);

        // Refresh items
        DB::delete("DELETE FROM product_items WHERE product_id = ?", [$id]);
        foreach ($request->item_ids as $index => $itemId) {
            $quantity = $request->quantities[$index];
            DB::insert("INSERT INTO product_items (product_id, item_id, quantity, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
                $id, $itemId, $quantity
            ]);
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $filename);

                DB::insert("INSERT INTO product_images (product_id, image, created_at) VALUES (?, ?, NOW())", [
                    $id, $filename
                ]);
            }
        }

        return redirect('/admin/production')->with('success', 'Product Updated!');
    }

    public function destroy($id)
    {
        // Delete product images
        $images = DB::select("SELECT image FROM product_images WHERE product_id = ?", [$id]);
        foreach ($images as $image) {
            $filePath = public_path('uploads/products/' . $image->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        DB::delete("DELETE FROM product_images WHERE product_id = ?", [$id]);

        // Delete product items
        DB::delete("DELETE FROM product_items WHERE product_id = ?", [$id]);

        // Delete product
        DB::delete("DELETE FROM products WHERE id = ?", [$id]);

        return redirect('/admin/production')->with('success', 'Product Deleted!');
    }

    public function deleteImage($id)
    {
        // Find image by id
        $image = DB::selectOne("SELECT * FROM product_images WHERE id = ?", [$id]);

        if ($image) {
            // Delete file from public/uploads/products
            $filePath = public_path('uploads/products/' . $image->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Remove from database
            DB::delete("DELETE FROM product_images WHERE id = ?", [$id]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }
}