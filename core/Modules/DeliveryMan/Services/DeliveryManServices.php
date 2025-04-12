<?php

namespace Modules\DeliveryMan\Services;

use Modules\DeliveryMan\Entities\DeliveryMan;
use Modules\DeliveryMan\Entities\DeliveryManOrder;
use Modules\DeliveryMan\Entities\DeliveryManRating;

class DeliveryManServices {
    const paginationLimit = 20;

    /**
     * @param int $deliveryManId
     * @return array
     */
    public static function tracking(int $deliveryManId): array
    {
        // display last 10 transaction
        // display last 10 order
        // display current order list
        // display last 10 review
        $deliveryMan = DeliveryMan::find($deliveryManId);

        $ordersList = DeliveryManOrder::with([
            "order.address",
            "order.address.country",
            "order.address.state",
            "order.address.cityInfo",
            "pickupPoint",
            "pickupPoint.country",
            "pickupPoint.state",
            "pickupPoint.city",
            "orderTrack" => function ($query){
                return $query->orderByDesc("order_tracks.id")->limit(1);
            }
        ])->whereDoesntHave("orderTrack", function ($orderTrackQuery) {
            $orderTrackQuery->where("name", "delivered");
        })->where("delivery_man_id", $deliveryManId)->latest()->paginate(self::paginationLimit);

        return ["deliveryMan" => $deliveryMan,"ordersList" => $ordersList];
    }

    /**
     * @param $deliveryManId
     * @return array
     */
    public static function histories($deliveryManId): array
    {
        // display last 10 transaction
        // display last 10 order
        // display current order list
        // display last 10 review
        $deliveryMan = DeliveryMan::find($deliveryManId);
        $deliveryManOrders = DeliveryManOrder::with([
            "order",
            "order.address",
            "order.address.country",
            "order.address.state",
            "order.address.cityInfo",
            "orderTrack" => function ($query){
                $query->orderByDesc("id")->limit(1);
            },
            "deliveryMan.presentAddress",
            "deliveryMan.presentAddress.country",
            "deliveryMan.presentAddress.state",
            "deliveryMan.presentAddress.city",
            "pickupPoint",
            "pickupPoint.country",
            "pickupPoint.state",
            "pickupPoint.city",
        ])->where("delivery_man_id", $deliveryMan->id)->latest()->paginate(self::paginationLimit);

        return ["deliveryMan" => $deliveryMan, "deliveryManOrders" => $deliveryManOrders];
    }


    /**
     * @param $deliveryManId
     * @return DeliveryMan
     */
    public static function ratings($deliveryManId): DeliveryMan
    {
        $deliveryMan = DeliveryMan::where("id", $deliveryManId)->firstOrFail();
        $deliveryMan->ratings = DeliveryManRating::with("user.profile_image")
            ->where("delivery_man_id", $deliveryMan->id)->latest()->paginate(self::paginationLimit);

        return $deliveryMan;
    }

    public static function generateDeliveryOrderAddress($deliveryManOrder): string
    {
        $deliveryOrderAddress = "";

        if($deliveryManOrder?->order?->address?->country?->address ?? false){
            if(!empty($deliveryOrderAddress))  $deliveryOrderAddress .= ", ";
            $deliveryOrderAddress .= $deliveryManOrder?->order?->address?->country?->address;
        }

        if($deliveryManOrder?->order?->address?->city?->name ?? false){
            if(!empty($deliveryOrderAddress))  $deliveryOrderAddress .= ", ";
            $deliveryOrderAddress .= $deliveryManOrder?->order?->address?->city?->name;
        }

        if($deliveryManOrder?->order?->address?->state?->name ?? false){
            if(!empty($deliveryOrderAddress))  $deliveryOrderAddress .= ", ";
            $deliveryOrderAddress .= $deliveryManOrder?->order?->address?->state?->name;
        }

        if($deliveryManOrder?->order?->address?->country?->name ?? false){
            if(!empty($deliveryOrderAddress))  $deliveryOrderAddress .= ", ";
            $deliveryOrderAddress .= $deliveryManOrder?->order?->address?->country?->name;
        }

        if($deliveryManOrder?->order?->address->zip_code ?? false){
            if(!empty($deliveryOrderAddress))  $deliveryOrderAddress .= ", ";
            $deliveryOrderAddress .= $deliveryManOrder?->order?->address->zip_code;
        }

        return $deliveryOrderAddress;
    }
    public static function generatePickupPointAddress($pickupPoint): string
    {
        return self::generateAddress($pickupPoint);
    }
    public static function generateDeliveryManAddress($deliveryMan): string
    {
        return self::generateAddress($deliveryMan);
    }

    /**
     * @param $deliveryMan
     * @return string
     */
    private static function generateAddress($deliveryMan): string
    {
        $pickupPointAddress = "";

        if ($deliveryMan?->country?->address ?? false) {
            if (!empty($pickupPointAddress)) {
                $pickupPointAddress .= ", ";
            }
            $pickupPointAddress .= $deliveryMan?->country?->address;
        }

        if ($deliveryMan?->city?->name ?? false) {
            if (!empty($pickupPointAddress)) {
                $pickupPointAddress .= ", ";
            }
            $pickupPointAddress .= $deliveryMan?->city?->name;
        }

        if ($deliveryMan?->state?->name ?? false) {
            if (!empty($pickupPointAddress)) {
                $pickupPointAddress .= ", ";
            }
            $pickupPointAddress .= $deliveryMan?->state?->name;
        }

        if ($deliveryMan?->country?->name ?? false) {
            if (!empty($pickupPointAddress)) {
                $pickupPointAddress .= ", ";
            }
            $pickupPointAddress .= $deliveryMan?->country?->name;
        }

        if ($deliveryMan->zip_code ?? false) {
            if (!empty($pickupPointAddress)) {
                $pickupPointAddress .= ", ";
            }
            $pickupPointAddress .= $deliveryMan->zip_code;
        }

        return $pickupPointAddress;
    }
}