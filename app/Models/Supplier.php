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
}
