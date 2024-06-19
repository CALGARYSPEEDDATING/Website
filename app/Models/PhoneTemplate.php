<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneTemplate extends Model
{
    

     protected $fillable = [
        'event_type',
		'template_name',
		'message_body'
    ];



}
