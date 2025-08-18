<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;

class SupportTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Support Ticket Message',
            from: new Address(config('mail.from.address'), config('mail.from.name')), // ✅ FIXED
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.support_ticket_message',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
