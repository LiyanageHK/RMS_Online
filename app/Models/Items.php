<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'description'];

    // Relationship: Item belongs to a category
    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    // Relationship: Items used in GRNs (Many-to-Many)
    public function grns()
    {
        return $this->belongsToMany(Grn::class, 'grn_items')->withPivot('quantity');
    }

    // Optional: Items used in Purchase Orders
    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'item_id');
    }
}
