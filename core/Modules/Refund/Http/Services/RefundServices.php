<?php

namespace Modules\Refund\Http\Services;

use Carbon\Carbon;
use Modules\Order\Entities\Order;
use Modules\Refund\Http\Abstracts\RefundRequestWithable;
use Modules\Refund\Http\Traits\RefundRequestData;

class RefundServices extends RefundRequestWithable
{
    use RefundRequestData;

    private ?RefundServices $instance = null;

    private static function instance($data, $orderId): ?RefundServices
    {
        $self = new self();
        $self->data = $data;
        $self->orderId = $orderId;


        if (!is_null($self->instance)) {
            return $self->instance;
        }

        return $self;
    }

    public static function prepareRefundRequestData($data, $orderId)
    {
        return self::instance($data, $orderId)->validatedRefundRequest();
    }

    public static function getProduct(int $orderId)
    {
        $order = Order::query()
            ->where("id", $orderId)
            ->with([
                "orderItems" => function ($query) {
                    $query->whereRelation("product", "is_refundable", 1);
                    $query->with("product", "variant");
                }
            ])
            ->withWhereHas("isDelivered")
            ->firstOrFail();

        dd($order);

        $addDay = get_static_option("how_long_user_will_eligible_for_refund");

        if ($order->isDelivered?->created_at?->addDay($addDay) < Carbon::now()) {
            return false;
        }


        return $order->orderItems ?? false;
    }
}