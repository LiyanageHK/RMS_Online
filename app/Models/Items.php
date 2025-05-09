<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = ['item_name', 'price']; 

    public function grns()
{
    return $this->belongsToMany(Grn::class, 'grn_items')->withPivot('quantity');
}

}
