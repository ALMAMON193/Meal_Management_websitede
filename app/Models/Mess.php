<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mess extends Model
{
    protected $guarded  = [];
    public function manager()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function bazaars()
    {
        return $this->hasMany(Market::class);
    }

    public function mealAttendances()
    {
        return $this->hasMany(Meal::class);
    }

    public function members()
    {
        return $this->hasMany(User::class, 'mess_id');
    }
}
