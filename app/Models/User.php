<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'manager_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship: A user belongs to a manager
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id')->where('role', 'manager');
    }

    // Relationship: A manager has many members
    public function managedMembers()
    {
        return $this->hasMany(User::class, 'manager_id')->where('role', 'member');
    }

    // Check if the user is a member
    public function isMember()
    {
        return $this->role === 'member';
    }
}
