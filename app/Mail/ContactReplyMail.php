<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $original_message;
    public $reply_message;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $original_message, $reply_message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->original_message = $original_message;
        $this->reply_message = $reply_message;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Reply to Your Contact Message')
            ->view('emails.contact-reply');
    }
}
