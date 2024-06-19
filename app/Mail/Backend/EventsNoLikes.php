<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventsNoLikes extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $emailNoLikes;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $emailNoLikes)
    {
        $this->user = $user;
        $this->emailNoLikes = $emailNoLikes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(' 👫 CSD Event Follow Up👫 ')->markdown('backend.event.mail.no_likes');
    }
}
