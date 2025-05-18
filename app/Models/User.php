<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Primary key column name (since it's not 'id')
    protected $primaryKey = 'user_id';

    // Primary key is an integer and auto-incrementing by default, so no need to override $incrementing or $keyType

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'profile_image',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays (e.g., JSON serialization).
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // You may add any relationships here, e.g.:
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
