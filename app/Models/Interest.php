<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Interest extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'interests';

    protected $fillable = [
        'corporate_id',
        'startup_id',
        'message',
        'status',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    public function corporate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'corporate_id');
    }

    public function startup(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'startup_id');
    }

    public function getCorporateProfile(): ?Profile
    {
        return Profile::where('user_id', $this->corporate_id)->first();
    }

    public function getStartupProfile(): ?Profile
    {
        return Profile::where('user_id', $this->startup_id)->first();
    }
}
