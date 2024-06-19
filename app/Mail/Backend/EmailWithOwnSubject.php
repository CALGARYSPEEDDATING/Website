<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailWithOwnSubject extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $description;
    public $subject;
    public $minAge;
    public $maxAge;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $description, $subject, $minAge, $maxAge)
    {
        $this->user = $user;
        $this->description = $description;
        $this->subject = $subject;
        $this->minAge = $minAge;
        $this->maxAge = $maxAge;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $male_age_range = 'M: '.$this->minAge.'-'.$this->maxAge;
        // $female_age_range = 'F: '.$this->minAge.'-'.$this->maxAge;
        
        return $this->subject($this->subject)->view('backend.event.mail.ownSubject');
    }
}
