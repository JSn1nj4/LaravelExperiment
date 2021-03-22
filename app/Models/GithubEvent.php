<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GithubEvent extends Model
{
    use HasFactory;

    protected $fillable = [
		'id',
		'type',
        'variant',
        'date',
        'user_id',
        'source',
        'repo',
    ];

    public function user()
    {
        return $this->hasOne(GithubUser::class);
    }
}
