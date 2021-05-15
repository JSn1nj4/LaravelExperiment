<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterUser extends Model
{
	use HasFactory;

	protected $fillable = [
		'id',
		'name',
		'screen_name',
		'profile_image_url_https',
	];

	public function getProfileUrlAttribute(): string
	{
		return "https://twitter.com/{$this->screen_name}";
	}

	public function tweets()
	{
		return $this->hasMany(Tweet::class);
	}
}
