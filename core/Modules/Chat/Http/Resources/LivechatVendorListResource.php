<?php

namespace Modules\Chat\Http\Resources;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class LivechatVendorListResource extends JsonResource
{
    /**
     * @throws Exception
     */
    public function toArray($request): array
    {
        return [
            "business_name" => $this->vendor?->business_name,
            "logo" => render_image($this->vendor?->logo, render_type: 'path'),
            "unseen_message_count" => $this->vendor_unseen_msg_count,
            "vendor_unique_identity" => random_int(11111111,99999999) . $this->vendor->id . random_int(111,999),
            "last_message" => $this->livechatMessage->first(),
        ];
    }
}
