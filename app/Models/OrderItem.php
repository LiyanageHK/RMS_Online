<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_details'; // explicitly mention table name if it doesn't follow Laravel naming

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'extra_toppings',
    ];


    // Relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
