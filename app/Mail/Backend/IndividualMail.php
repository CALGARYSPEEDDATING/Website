<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class IndividualMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $description;
    public $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $description, $event)
    {
        $this->user = $user;
        $this->description = $description;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->event->title)->view('backend.event.mail.individualMail');
    }
}
