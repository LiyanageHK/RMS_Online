<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class product extends Model
{

    use HasFactory;

    protected $fillable = [
       'name',
       'description', 
       'status',
       'small',
       'medium',
       'large',
       
    ];

    public function image()
{
    return $this->hasOne(ProductImage::class);
}
}
