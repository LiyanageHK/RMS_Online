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

    protected $table = 'delivery';
    protected $primaryKey = 'delivery_id';
    public $incrementing = 'ture';
    protected $keyType = 'int';



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
