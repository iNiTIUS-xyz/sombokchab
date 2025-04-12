<?php

namespace Modules\Refund\Mail;

use Illuminate\Bus\Queueable;use Illuminate\Mail\Mailable;use Illuminate\Mail\Mailables\Content;use Illuminate\Mail\Mailables\Envelope;use Illuminate\Queue\SerializesModels;

class RefundTrackStatusMail extends Mailable
{
    public function __construct(private $data)
    {

    }

    public function build()
    {
        return $this->from(get_static_option('site_global_email'), get_static_option('site_title'))
            ->subject($this->data['subject'])
            ->view('refund::emails.refund-track-status', ["data" => $this->data]);
    }
}
