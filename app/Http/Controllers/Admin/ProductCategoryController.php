<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{

    public function index()
    {
        $categories = DB::select("SELECT * FROM product_categories");
        return view('admin.productcategories.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('admin.productcategories.create');
    }

    // Save new category
    public function store(Request $request)
    {
        DB::insert("INSERT INTO product_categories (name) VALUES (?)", [
            $request->input('name')
        ]);

        return redirect('admin/productcategories')->with('success', 'Category added!');
    }

    // Show edit form
    public function edit($id)
    {
        $category = DB::selectOne("SELECT * FROM product_categories WHERE id = ?", [$id]);
        return view('admin.productcategories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        DB::update("UPDATE product_categories SET name = ? WHERE id = ?", [
            $request->input('name'),
            $id
        ]);

        return redirect('admin/productcategories')->with('success', 'Category updated!');
    }

    // Delete category
    public function destroy($id)
    {
        DB::delete("DELETE FROM product_categories WHERE id = ?", [$id]);
        return redirect()->back()->with('success', 'Category deleted!');
    }

    // Download report
    public function downloadReport()
    {
        $categories = DB::select("SELECT * FROM product_categories");

        $csvData = "ID,Name,Created At,Updated At\n";

        foreach ($categories as $category) {
            $csvData .= "{$category->id},{$category->name},{$category->created_at},{$category->updated_at}\n";
        }

        $fileName = "product_categories_report_" . date('Y-m-d_H-i-s') . ".csv";
        Storage::put($fileName, $csvData);

        return response()->download(storage_path("app/" . $fileName))->deleteFileAfterSend(true);
    }
}
