<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
    protected $fillable = [
        'event_id',
    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
