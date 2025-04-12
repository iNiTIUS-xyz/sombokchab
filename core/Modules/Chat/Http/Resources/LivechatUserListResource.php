<?php

namespace Modules\Chat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LivechatUserListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "name" => $this->user?->name,
            "profile_image" => render_image($this->user?->image, render_type: 'path'),
            "unseen_message_count" => $this->user_unseen_msg_count,
            "vendor_unique_identity" => random_int(11111111,99999999) . $this->user->id . random_int(111,999),
            "last_message" => $this->livechatMessage->first(),
        ];
    }
}
