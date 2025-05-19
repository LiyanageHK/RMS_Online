<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'email',
        'phone',
        'address',
        'contact_person_name',
        'contact_person_phone',
        'contact_person_email',
    ];

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class, 'supplier_id');
    }

    public function grns()
    {
        return $this->hasMany(GRN::class, 'supplier_id');
    }
}
