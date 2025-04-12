<?php

namespace Modules\DeliveryMan\Listeners;

use App\Http\Services\NotificationService;
use Illuminate\Support\Facades\Http;
use Modules\DeliveryMan\Entities\DeliveryManOrder;
use Modules\DeliveryMan\Entities\DeliveryManPickupPoint;
use Modules\DeliveryMan\Events\AssignDeliveryManEmail;
use Modules\DeliveryMan\Services\DeliveryManNotificationService;

class AssignDeliveryManPushNotificationListener
{
    public function __construct()
    {
    }

    public function handle(AssignDeliveryManEmail $event): void
    {
        $data = $event->data;
        $deliveryMan = $event->data["deliveryMan"];

        if ($deliveryMan->firebase_device_token){
            // fetch pickup point data from database
            $pickupPoint = DeliveryManPickupPoint::with("country:id,name","state:id,name","city:id,name","zone:id,name")
                ->find($data["pickupPoint"]);

            $pickupPointAddr = "";

            if(!empty($pickupPoint->country)){
                $pickupPointAddr .= $pickupPoint->country?->name . ' , ';
            }
            if(!empty($pickupPoint->state)){
                $pickupPointAddr .= $pickupPoint->state?->name . ' , ';
            }
            if(!empty($pickupPoint->city)){
                $pickupPointAddr .= $pickupPoint->city?->name . ' , ';
            }
            if(!empty($pickupPoint->address)){
                $pickupPointAddr .= $pickupPoint->address;
            }

            $notificationBody = [
                'title' => __('You have received a new order for delivery'),
                'detailed_title' => __('Your pickup point is') . ': ' . $pickupPointAddr,
                'id' => $data["deliveryManOrder"]->order_id,
                'body' => __('Your pickup point is') . ': ' . $pickupPointAddr,
                'zone' => $pickupPoint->zone?->name,
                'description' => '',
                'type' => 'assigned_delivery_man',
                'sound' => 'default',
                'fcm_device' => '',
                'screen' => 'assign_delivery_man',
                'deliveryMan' => $deliveryMan
            ];

            Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'key=' . get_static_option('firebase_server_key'),
            ])->post('https://fcm.googleapis.com/fcm/send', [
                'message' => [
                    'body' => 'subject',
                    'title' => 'title',
                ],
                'priority' => 'high',
                'data' => $notificationBody,
                'to' => $deliveryMan->firebase_device_token,
            ]);

            $deliveryOrder = DeliveryManOrder::where('delivery_man_id', $deliveryMan->id)->first();


            DeliveryManNotificationService::init($deliveryOrder)
                ->setDeliveryManId($deliveryMan->id)
                ->setType("delivery_man")
                ->setNotificationData($notificationBody)->send($deliveryOrder, "create");
        }
    }
}
