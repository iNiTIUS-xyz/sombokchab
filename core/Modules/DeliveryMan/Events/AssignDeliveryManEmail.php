<?php

namespace Modules\DeliveryMan\Events;

use Illuminate\Queue\SerializesModels;

class AssignDeliveryManEmail
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public mixed $data)
    {
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
