<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerfMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;
  
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Code Email',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'varificationemail.CodeMail',
            with: [
                'mailData' => $this->mailData
            ]
        );
    }
    public function build()
    {
        return $this->subject(subject: 'Code Email')
            ->view('varificationemail.CodeMail')
            ->with('mailData', $this->mailData);
    }
    public function attachments(): array
    {
        return [];
    }
}