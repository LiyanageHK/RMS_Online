<?php

// app/Http/Controllers/InventoryController.php

namespace App\Http\Controllers;

use App\Models\Inventory; // Import the Inventory model
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    // Method to display the inventory center page
    public function index()
    {
        // Fetch all inventory items from the database
        $inventories = Inventory::all();

        // Return the 'InventoryCenter' view and pass the inventory data
        return view('InventoryCenter', compact('inventories'));
    }
}

