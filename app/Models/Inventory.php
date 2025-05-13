<?php

// app/Models/Inventory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Specify the table name if it is not the plural form of the model name
    protected $table = 'inventories'; // Optional if your table name is plural of model

    // Define the fillable fields (columns) that can be mass-assigned
    protected $fillable = [
        'item_code', // Example column name
        'item_name', // Example column name
        'item_quantity', // Example column name
        'item_unit', // Example column name
        'item_description', // Example column name
    ];

    // Optionally, specify the primary key if it's not 'id'
    protected $primaryKey = 'id'; // Default primary key is 'id'

    // If your primary key is not auto-incrementing, set this to false
    public $incrementing = true; // Set to false if not auto-incrementing

    // Specify the data type of the primary key (default is 'int')
    protected $keyType = 'int'; // Adjust if your primary key is a different type, e.g. 'string'
    
    // If your table uses timestamps, set this to true (default is true)
    public $timestamps = true; // Set to false if your table doesn't have created_at and updated_at fields
}
