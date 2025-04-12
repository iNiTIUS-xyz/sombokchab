<?php

namespace Modules\Refund\Http\Services;

use App\Http\Services\NotificationService;

class RefundNotificationService extends NotificationService
{
    public function generateMessage($type): string
    {
        return match($type){
            "created" => __("New refund request is created by vendor"),
            "status_changed" => __("Refund status is changed by admin")
        };
    }
}