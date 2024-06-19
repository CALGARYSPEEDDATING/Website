<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Event;
use App\Models\Payment;
use App\Models\UserMatch;
use App\Models\DatingProfile;
use App\Models\System\Session;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\PasswordHistory;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    public function profile()
    {
        return $this->hasOne(DatingProfile::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot(
            'id',
            'paid',
            'wait_list',
            'waiver',
            'checked',
            'created_at',
            'updated_at'
        );
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Match System

    public function likesToUsers()
    {
        return $this->belongsToMany(self::class, 'matches', 'user_id', 'liked_user_id');
    }

    public function likesFromUsers()
    {
        return $this->belongsToMany(self::class, 'matches', 'liked_user_id', 'user_id');
    }

    public function matches($event_id)
    {
        $ids = $this->likesToUsers()->pluck('liked_user_id');
        return $this->likesFromUsers()
            ->select('user_id', 'first_name', 'last_name', 'email', 'phone')
            ->where('event_id', $event_id)
            ->whereIn('user_id', $ids);
    }
}
