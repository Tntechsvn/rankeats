<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailManagerBusiness extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
        $this -> user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {       
        return $this->subject($this->user['subject'])->view('mail.mail_follwers');
    }
}
