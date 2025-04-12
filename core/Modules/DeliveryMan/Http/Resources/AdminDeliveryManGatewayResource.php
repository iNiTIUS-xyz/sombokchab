<?php

namespace Modules\DeliveryMan\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\DeliveryMan\Entities\DeliveryManWalletGateway;

/** @mixin DeliveryManWalletGateway */
class AdminDeliveryManGatewayResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'fields' => unserialize($this->fields),
            'status_id' => $this->status_id,
        ];
    }
}
