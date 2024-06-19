<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class DatingProfile extends Model
{
    protected $fillable = [
        'profile',
        'gender',
        'a_phone',
        'matches_info',
        'about_us',
        'subscribed',
        'newsletter',
        'pass_events'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
