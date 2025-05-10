<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees'; // Ensure this is the correct table name

    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'address',
    ];

    // You can define scopes here if you want
    public function driver()
    {
        return $this->belongsTo(Employee::class, 'driver_id');
    }
}
