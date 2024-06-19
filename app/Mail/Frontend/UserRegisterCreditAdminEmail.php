<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterCreditAdminEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $event;
    public $payment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $event, $payment)
    {
        $this->user = $user;
        $this->event = $event;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(date("F j, Y", strtotime($this->event->start_datetime)).' Registration Information')->markdown('frontend.event.mail.admincreditrigister');
    }
}
