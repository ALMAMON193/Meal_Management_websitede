<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketItem extends Model
{
    protected $fillable = ['name', 'price', 'date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
