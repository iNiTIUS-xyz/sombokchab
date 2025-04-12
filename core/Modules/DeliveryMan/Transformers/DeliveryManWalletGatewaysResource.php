<?php

namespace Modules\DeliveryMan\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryManWalletGatewaysResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "name" => $this->name,
            "fields" => unserialize($this->fields),
            "identity" => $this->id
        ];
    }
}
