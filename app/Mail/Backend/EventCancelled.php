<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(
            $this->event->title.' '.$this->event->address.' '.date("F j, Y", strtotime($this->event->start_datetime))
        )->markdown('backend.event.mail.cancelled');
    }
}
