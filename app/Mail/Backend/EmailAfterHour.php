<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAfterHour extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $emailAfterHour;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $emailAfterHour)
    {
        $this->user = $user;
        $this->emailAfterHour = $emailAfterHour;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Speed Dating Match Results and Request for Review')->markdown('backend.event.mail.emailAfterHour');
    }
}
