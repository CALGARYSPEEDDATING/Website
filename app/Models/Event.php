<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Auth\User;
use Carbon\Carbon;
use App\Models\Payment;

class Event extends Model
{
    protected $dates = [
        'start_datetime',
        'end_datetime',
        'matches_submitted_time',
    ];
    protected $with = [
        'details'
    ];

    public function details()
    {
        return $this->hasOne(EventDetails::class, 'event_id');
    }
    public function getSlugAttribute(): string
    {
        return str_slug($this->title);
    }

    public function getUrlAttribute(): string
    {
        return action('Frontend\EventController@show', [$this->id, $this->slug]);
    }
    

    public function hasExpired()
    {
        return $this->freshTimestamp()->gt($this->end_datetime);
    }
    // public function notExpired()
    // {
    //     return $this->freshTimestamp()->lt($this->end_datetime);
    // }

    public function scopeUpcoming(Builder $builder)
    {
        return $builder->orderBy('start_datetime', 'asc');
    }

    public function scopeNotExpired(Builder $builder)
    {
        return $builder->whereDate('start_datetime', '>=', Carbon::now()->toDateString());
    }
    

    public function scopeApproved(Builder $builder)
    {
        return $builder->where('status', 1);
    }

    // Relationships
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(
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
}
