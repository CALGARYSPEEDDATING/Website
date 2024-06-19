<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailByAgeGroup extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $event;
    public $description;
    // public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $event, $description, $subject)
    {
        $this->event = $event;
        $this->user = $user;
        $this->description = $description;
        // $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $male_age_range = 'M: '.$this->event->details->male_age_from.'-'.$this->event->details->male_age_to;
        $female_age_range = 'F: '.$this->event->details->female_age_from.'-'.$this->event->details->female_age_to;
        // if($this->subject)
        //     return $this->subject($this->subject.' '.$female_age_range.' '.$male_age_range.'. '.date("F j, Y", strtotime($this->event->start_datetime)))->view('backend.event.mail.byagegroup');
        // else
            return $this->subject($this->event->title.' '.$female_age_range.' '.$male_age_range.'. '.date("F j, Y", strtotime($this->event->start_datetime)))->view('backend.event.mail.byagegroup');
    }
}
