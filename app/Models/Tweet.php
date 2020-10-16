<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $casts = [
        'entities' => 'array',
    ];

    protected $fillable = [
        'tweet_id',
        'user_id',
        'body',
        'date',
        'sub_tweet_id',
        'entities',
    ];

    public function user()
    {
        return $this->belongsTo(TwitterUser::class);
    }
}
