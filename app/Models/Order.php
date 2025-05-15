<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'created_at',
        'updated_at',
        'address',
        'landmark',
        'phone',
        'total',
        'payment_status',
        'order_status'
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }


    // Relationship: Each Order belongs to one User
    // Relationship to User (optional but useful)
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class);
}





}
