<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{


    protected $fillable = [
        'user_id',
        'date',
        'meal_count'
    ];

    protected $casts = [
        'date' => 'date',
        'meal_count' => 'decimal:1'
    ];

   public function user(){
        return $this->belongsTo(User::class);
   }
}
