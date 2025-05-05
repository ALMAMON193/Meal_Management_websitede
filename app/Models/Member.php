<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'manager_id',
        'member_code',
    ];

    // Relationship: A member belongs to a user (the member)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: A member belongs to a manager
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
