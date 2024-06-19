<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
   protected $guarded =[];
    public function events()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
