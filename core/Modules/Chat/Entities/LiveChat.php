<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\User\Entities\User;
use Modules\Vendor\Entities\Vendor;

class LiveChat extends Model
{
    protected $fillable = [
        'user_id',
        'vendor_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id","id");
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class,"vendor_id","id");
    }

    public function livechatMessage(): HasMany
    {
        return $this->hasMany(LiveChatMessage::class,"live_chat_id","id");
    }

    public function vendor_unseen_msg(): HasMany
    {
        return $this->hasMany(LiveChatMessage::class,"live_chat_id","id")
            ->where("live_chat_messages.from_user", 1)
            ->where("live_chat_messages.is_seen", 0);
    }

    public function user_unseen_msg(): HasMany
    {
        return $this->hasMany(LiveChatMessage::class,"live_chat_id","id")
            ->where("live_chat_messages.from_user", 2)
            ->where("live_chat_messages.is_seen", 0);
    }
}
