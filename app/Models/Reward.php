<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    // Define the table name if it differs from the plural form of the model name
    protected $table = 'rewards'; // Adjust the table name if necessary

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name', // Example: Reward name
        'points_required', // Example: Points required to redeem the reward
        'description', // Example: Description of the reward
        'status', // Example: Active/Inactive status
    ];

    // Define any relationships (optional)
    // Example: If a reward belongs to a user or has many transactions, you can define relationships like so:

    /**
     * The users that have redeemed this reward.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_rewards'); // Assuming you have a pivot table for user rewards
    }

    /**
     * Get the reward's status as a readable string (example).
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Capitalize the first letter of the status (active/inactive)
    }

    // Optionally, add more methods for business logic (e.g., calculating points, etc.)
}
