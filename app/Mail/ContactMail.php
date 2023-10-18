<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $from;
    public function __construct($data)
    {
        $this->data = $data;
        $this->from =  [
            'address' => $data['email'],
            'name' => $data['name'],
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('رسالة من ' . $this->data['name'])->from($this->from)->view('mail.contact');
    }
}
