<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventsMultipleMatches extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $matches;
    public $emailMultipleMatches;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $matches, $emailMultipleMatches)
    {
        $this->user = $user;
        $this->matches = $matches;
        $this->emailMultipleMatches = $emailMultipleMatches;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(' 👫  Your Matches ❗')->markdown('backend.event.mail.multiple_matches');
    }
}
