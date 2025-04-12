<?php

namespace Modules\DeliveryMan\Services;

use App\Http\Services\NotificationService;

class DeliveryManNotificationService extends NotificationService
{
    private array|object|null $notificationData = [];

    public function setNotificationData(array|object|null $notificationData): static
    {
        $this->notificationData = $notificationData;
        return $this;
    }

    public function generateMessage($type): bool|string
    {
        return match($type){
            "create" => json_encode($this->notificationData),
        };
    }
}