<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    use HasFactory;

    protected $fillable = [
       'name',
        'address',
        'landmark',
        'phone',
        'total',
        'u_id',
        'payment_status',
        'order_status'
    ];

    // Order.php
public function orderDetails()
{
    return $this->hasMany(OrderDetail::class);
}
public function details()
{
    return $this->hasMany(OrderDetail::class, 'order_id');
}

}