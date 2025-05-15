<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Mess extends Model
{
    protected $fillable = ['name', 'address', 'user_id', 'mess_id'];
    public function manager(): \Illuminate\Database\Eloquent\Relations\BelongsTo
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
}
