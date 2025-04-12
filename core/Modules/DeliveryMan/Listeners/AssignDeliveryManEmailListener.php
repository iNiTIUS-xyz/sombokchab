<?php

namespace Modules\DeliveryMan\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\DeliveryMan\Emails\AssignDeliveryManMail;
use Modules\DeliveryMan\Entities\DeliveryManPickupPoint;
use Modules\DeliveryMan\Events\AssignDeliveryManEmail;
use Modules\DeliveryMan\Mail\AssignDeliveryManToUserMail;

class AssignDeliveryManEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param AssignDeliveryManEmail $event
     * @return void
     */
    public function handle(AssignDeliveryManEmail $event)
    {
        $deliveryMan = $event->data["deliveryMan"];
        $order = $event->data["order"];

        // fetch pickup point data from database
        $pickupPoint = DeliveryManPickupPoint::with("country:id,name","state:id,name","city:id,name","zone:id,name")
            ->find($event->data["pickupPoint"]);

        $pickupPointAddr = "<h3 style='margin-bottom: 6px'>". __("Pickup point address:") ." </h3><br><p><b>". __("Zone:") ." </b>" . $pickupPoint->zone?->name . "</p><p><b>" . __("Address:") . '</b> ';
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

        $pickupPointAddr .= "</p><br><b>". __("Delivery Time:") ."</b> " . $event->data["deliveryManOrder"]->delivery_date . "<br>";
        $pickupPointAddr .= "<b>". __("Contact Number:") ."</b> " . $pickupPoint->contact_number . "<br>";
        $pickupPointAddr .= "<b>". __("Operating Hours:") ."</b> " . $pickupPoint->operating_hours . "<br><br>";

        $orderInformationMarkup = view("deliveryman::mail.order-information-markup", $event->data);
        $deliveryManInformation = view("deliveryman::mail.delivery-man-information",$event->data);

        $message = str_replace(["@username", "@pickupPoint","@orderInformation","@break"],[
            "<b>". $deliveryMan->full_name ."</b>",
            $pickupPointAddr,
            $orderInformationMarkup,
            "<br>"
        ], get_static_option("assign_delivery_man_mail_body"));

        $orderTrackingLink = '<a href="'. route("order.order-tracking", $order->id) .'" target="_blank">' . route("order.order-tracking", $order->id) . '</a>';

        $message2 = str_replace(["@username", "@deliveryManInformation","@break","@orderTrackingLink"],[
            "<b>". $order->address->name ."</b>",
            $deliveryManInformation,
            "<br>",
            $orderTrackingLink
        ], get_static_option("assign_delivery_man_mail_to_user_body"));

        $data = [
            "subject" => get_static_option("assign_delivery_man_mail_subject"),
            "body" => $message,
            "order" => $order,
            "deliveryMan" => $deliveryMan,
            "email" => $deliveryMan->email
        ];

        $data2 = [
            "subject" => get_static_option("assign_delivery_man_mail_to_user_subject"),
            "body" => $message2,
            "order" => $order,
            "deliveryMan" => $deliveryMan,
            "email" => $deliveryMan->email
        ];


        try {
            Mail::to($deliveryMan->email)->send(new AssignDeliveryManMail($data));
            Mail::to($order->address?->email)->send(new AssignDeliveryManToUserMail($data2));
        } catch (\Exception $e) {
            Log::error('exception is com', $e->getMessage());
        }
    }
}
