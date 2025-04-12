<?php

namespace Modules\DeliveryMan\Services;

class DeliveryManTrackStatusService
{
    public static function get($status): array
    {
        return match ($status)
        {
            "ordered" => ["assigned_delivery_man" => "Assigned Delivery Man"],
            "assigned_delivery_man" => ["ready_for_pickup" => "Ready For Pickup"],
            "ready_for_pickup" => ["picked_up" => "Picked UP"],
            "picked_up" => ["on_the_way" => "On The Way"],
            "on_the_way" => ["cancel" => "Cancel","delivered" => "Delivered"],
        };
    }
}