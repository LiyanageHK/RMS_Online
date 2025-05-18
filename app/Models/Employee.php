<?php

namespace App\Models;
//namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Employee extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nic',
        'phone',
        'position', // Add this to store the foreign key
        'password',
        'address_line1',
        'address_line2',
        'city',
        'postal_code',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Relationship: Each employee belongs to a role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Accessor: Get the role name directly.
     */
    public function getRoleNameAttribute()
    {
        return $this->role?->name ?? 'N/A';
    }

}
