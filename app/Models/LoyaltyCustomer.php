<?php

// app/Models/LoyaltyCustomer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyCustomer extends Model
{
    protected $table = 'loyalty_customers';
    protected $primaryKey = 'loyalty_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'loyalty_level',
    ];

    // Optional relationship back to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
