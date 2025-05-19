<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExport;

class ItemController extends Controller
{
    public function index()
    {
        $items = DB::select("SELECT items.*, item_categories.name AS category_name FROM items 
                             LEFT JOIN item_categories ON items.category_id = item_categories.id");
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = DB::select("SELECT * FROM item_categories");
        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        DB::insert("INSERT INTO items (category_id, name, price, description,alert_level, created_at, updated_at)
                    VALUES (?, ?, ?, ?,?, NOW(), NOW())", [
            $request->category_id,
            $request->name,
            $request->price,
            $request->description,
            $request->alert_level
        ]);
        return redirect('/admin/items')->with('success', 'Item Added!');
    }

    public function edit($id)
    {
        $item = DB::selectOne("SELECT * FROM items WHERE id = ?", [$id]);
        $categories = DB::select("SELECT * FROM item_categories");
        
        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        DB::update("UPDATE items SET category_id = ?, name = ?, price = ?, description = ?,alert_level = ?, updated_at = NOW()
                    WHERE id = ?", [
            $request->category_id,
            $request->name,
            $request->price,
            $request->description,
            $request->alert_level,
            $id
        ]);
        return redirect('/admin/items')->with('success', 'Item Updated!');
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM items WHERE id = ?", [$id]);
        return redirect('/admin/items')->with('success', 'Item Deleted!');
    }

    public function downloadReport()
    {
        $items = DB::select("SELECT items.*, item_categories.name AS category_name FROM items 
                             LEFT JOIN item_categories ON items.category_id = item_categories.id");

        $csvData = "ID,Name,Category,Price,Description\n";

        foreach ($items as $item) {
            $csvData .= "{$item->id},{$item->name},{$item->category_name},{$item->price},{$item->description}\n";
        }

        $fileName = "items_report_" . date('Y-m-d_H-i-s') . ".csv";
        Storage::put($fileName, $csvData);

        return response()->download(storage_path("app/" . $fileName))->deleteFileAfterSend(true);
    }
}
