<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected array $casts = [
        'entities' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(TwitterUser::class);
    }
}
