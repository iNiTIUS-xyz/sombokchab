<?php

namespace Modules\DeliveryMan\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignDeliveryManMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
            ->subject($this->args["subject"])->view('deliveryman::mail.assign-delivery-man-mail', $this->args);
    }
}
