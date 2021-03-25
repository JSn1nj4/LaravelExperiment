<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GithubEvent extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'string',
    ];

    protected $dates = [
        'date',
    ];

    protected $fillable = [
		'id',
		'type',
        'action',
        'date',
        'user_id',
        'source',
        'repo',
    ];

    public function user()
    {
        return $this->belongsTo(GithubUser::class);
    }
}
