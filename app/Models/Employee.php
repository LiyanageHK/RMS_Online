<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nic',
        'phone',
        'position',
        'password',
        'address_line1',
        'address_line2',
        'city',
        'postal_code',
    ];

    protected $hidden = [
        'password',
    ];
}
