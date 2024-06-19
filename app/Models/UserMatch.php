<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
	protected $table = "matches";
	protected $fillable = [
		'user_id',
		'liked_user_id',
		'event_id',
		'matched',
		'comment',
	];
	public function users()
    {
        return $this->belongsTo(User::class, 'liked_user_id');
    }
}
