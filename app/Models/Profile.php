<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Profile extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'profiles';

    protected $fillable = [
        'user_id',
        'company_name',
        'tagline',
        'description',
        'industry',
        'stage',
        'location',
        'website',
        'funding_needed',
        'team_size',
        'tags',
    ];

    protected $casts = [
        'tags'      => 'array',
        'team_size' => 'integer',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
