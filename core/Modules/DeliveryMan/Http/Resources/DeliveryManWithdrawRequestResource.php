<?php

namespace Modules\DeliveryMan\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryManWithdrawRequestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'amount' => $this->amount,
            'gateway_id' => $this->gateway_id,
            'delivery_man_id' => $this->delivery_man_id,
            'request_status' => $this->request_status,
            'gateway_fields' => json_decode($this->gateway_fields),
            'note' => $this->note,
            'image' => $this->image,
            'gateway_name' => $this->gateway->name
        ];
    }
}
