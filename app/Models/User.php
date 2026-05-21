<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function sentInterests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Interest::class, 'corporate_id');
    }

    public function receivedInterests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Interest::class, 'startup_id');
    }
}
