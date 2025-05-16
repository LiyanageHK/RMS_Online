<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GRNItem extends Model
{
    use HasFactory;

    protected $table = 'grn_items';
    protected $fillable = ['grn_id', 'item_id', 'quantity'];

    // Relationship to GRN
    public function grn()
    {
        return $this->belongsTo(GRN::class, 'grn_id'); // Ensure the correct foreign key name
    }

    // Relationship to Item
    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
}


