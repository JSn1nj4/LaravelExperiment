<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $dates = [
        'expires_at',
    ];

    protected $fillable = [
        'service',
        'expires_at',
        'value',
    ];
}
