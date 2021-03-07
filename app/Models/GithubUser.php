<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GithubUser extends Model
{
    use HasFactory;

    public function events()
    {
        return $this->hasMany(GithubEvent::class);
    }
}
