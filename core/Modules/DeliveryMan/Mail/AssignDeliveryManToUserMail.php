<?php

namespace Modules\DeliveryMan\Mail;

use Illuminate\Bus\Queueable;use Illuminate\Mail\Mailable;use Illuminate\Mail\Mailables\Content;use Illuminate\Mail\Mailables\Envelope;use Illuminate\Queue\SerializesModels;

class AssignDeliveryManToUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private array $args)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->from(get_static_option('site_global_email'), get_static_option('site_title'))
            ->subject($this->args["subject"])->view('deliveryman::mail.assign-delivery-man-mail-to-user', $this->args);
    }
}
