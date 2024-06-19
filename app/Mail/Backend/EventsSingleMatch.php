<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventsSingleMatch extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $match;
    public $emailSingleMatch;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $match, $emailSingleMatch)
    {
        $this->user = $user;
        $this->match = $match;
        $this->emailSingleMatch = $emailSingleMatch;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('👫  Your Match ❗')->markdown('backend.event.mail.single_match');
    }
}
