<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemCategoryController extends Controller
{
    
    public function index()
    {
        $categories = DB::select("SELECT * FROM item_categories ORDER BY id DESC");
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        DB::insert("INSERT INTO item_categories (name, created_at, updated_at) VALUES (?, NOW(), NOW())", [
            $request->name
        ]);
        return redirect('/admin/categories')->with('success', 'Category added!');
    }

    public function edit($id)
    {
        $category = DB::selectOne("SELECT * FROM item_categories WHERE id = ?", [$id]);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        DB::update("UPDATE item_categories SET name = ?, updated_at = NOW() WHERE id = ?", [
            $request->name, $id
        ]);
        return redirect('/admin/categories')->with('success', 'Category updated!');
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM item_categories WHERE id = ?", [$id]);
        return redirect('/admin/categories')->with('success', 'Category deleted!');
    }
}
