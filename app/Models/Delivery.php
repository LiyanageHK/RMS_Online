<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    protected $fillable = [

        'order_id',

         'driver_id',
        'address',    // Add address if it's fillable
        'landmark',   // Add landmark if it's fillable
        'phone',      // Add phone if it's fillable
        'total',
        'assigned_to'
    ];

    use HasFactory;

    protected $table = 'delivery'; // change 'your_table_name' to the actual table name in your DB
    protected $primaryKey = 'delivery_id'; // Change this to your actual column name
    public $incrementing = false; // Set to false if it's not auto-incrementing
    protected $keyType = 'string'; // Use 'int' if your primary key is an integer




    // Define relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function driver()
    {
        return $this->belongsTo(Employee::class, 'driver_id');
    }


}
