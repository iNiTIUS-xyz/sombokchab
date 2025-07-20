<?php

namespace Modules\Refund\Http\Services;

class RefundTrackStatus
{

    public static function get($currentStatus): array
    {
        return match ($currentStatus) {
            "request_sent" => ["approved" => "Approved", "declined" => "Declined"],
            "approved" => ["ready_for_pickup" => "Ready For Pickup"],
            "ready_for_pickup" => ["canceled_by_delivery_man" => "Canceled by delivery man", "picked_up" => "Picked UP"],
            "picked_up" => ["cancel" => "Cancel", "verify_product" => "Verify Product", "exchange" => "Exchange"],
            "cancel", "exchange" => ["on_the_way" => "On the way"],
            "on_the_way" => ["product_returned" => "Product Returned"],
            "verify_product" => ["payment_processing" => "Payment Processing"],
            "payment_processing" => ["payment_returned" => "Payment Returned"],
            "payment_returned" => ["payment_completed" => "Payment Completed"],
            "canceled_by_delivery_man", "product_returned", "payment_completed" => [],
            "declined" => []
        };
    }
}