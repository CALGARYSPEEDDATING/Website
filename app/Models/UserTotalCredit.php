<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class UserTotalCredit extends Model
{
    protected $table = 'user_total_credits';
    protected $guarded = [];

    
	public function users()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
