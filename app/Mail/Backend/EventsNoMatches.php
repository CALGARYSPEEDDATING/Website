<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventsNoMatches extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $likes;
    public $emailNoMatches;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $likes, $emailNoMatches)
    {
        $this->user = $user;
        $this->likes = $likes;
        $this->emailNoMatches = $emailNoMatches;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(' 👫 CSD Event Follow Up👫 ')->markdown('backend.event.mail.no_matches');
    }
}
