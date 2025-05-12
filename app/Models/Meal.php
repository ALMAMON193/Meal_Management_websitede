<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'user_id',
        'meal_id',
        'date',
        'breakfast',
        'lunch',
        'dinner'
    ];

    protected $casts = [
        'date' => 'date',
        'breakfast' => 'float',
        'lunch' => 'float',
        'dinner' => 'float'
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mess()
    {
        return $this->belongsTo(Mess::class);
    }
}
