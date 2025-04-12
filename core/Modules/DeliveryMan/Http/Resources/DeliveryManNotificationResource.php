<?php

namespace Modules\DeliveryMan\Http\Resources;

use App\XGNotification;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin XGNotification */
class DeliveryManNotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'message' => json_decode($this->message),
            'type' => $this->type,
            'delivery_man_id' => $this->delivery_man_id,
            'is_read_delivery_man' => $this->is_read_delivery_man,
            'created_at' => $this->created_at,
        ];
    }
}
