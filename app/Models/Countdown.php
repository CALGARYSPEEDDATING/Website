<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countdown extends Model
{
    protected $table = 'countdown';
    protected $guarded = [];
    protected $dates = [
        'event_start_date' => 'datetime',
        'countdown' => 'datetime',
     ];
}
