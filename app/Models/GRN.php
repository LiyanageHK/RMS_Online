<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;

    protected $table = 'grns'; 
    protected $fillable = ['grn_date', 'supplier_id', 'reference'];

    public function items()
    {
        return $this->hasMany(GRNItem::class,'grn_id');
    }

    public function supplier()
{
    return $this->belongsTo(Supplier::class);
}
}


