<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $question;

    public function __construct($name, $email, $question)
    {
        $this->name = $name;
        $this->email = $email;
        $this->question = $question;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova Mensagem de Contacto - ' . $this->name,
            replyTo: [$this->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
        );
    }
}