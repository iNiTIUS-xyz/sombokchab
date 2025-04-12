<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Http;
use Modules\User\Entities\User;
use Modules\Vendor\Entities\Vendor;

class LiveChatMessage extends Model
{
    protected $fillable = [
        'live_chat_id',
        'from_user',
        'message',
        'file',
    ];

    protected $casts = [
        'message' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function liveChat(): BelongsTo
    {
        return $this->belongsTo(LiveChat::class, 'live_chat_id', 'id');
    }

    public function user(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, LiveChat::class, 'live_chat_id', 'id', 'id', 'user_id');
    }

    public function vendor(): HasManyThrough
    {
        return $this->hasManyThrough(Vendor::class, LiveChat::class, 'live_chat_id', 'id', 'id', 'vendor_id');
    }

    // this method will be return file path
    public function getFilePathAttribute()
    {
        return $this->file;
    }

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($modal) {
            // first check who is the sender of this message if this is a customer, then send notification to the vendor
            // get vendor from the message
            $vendor = $modal->liveChat->vendor;
            $user = $modal->liveChat->user;

            // send notification to the vendor
            $notificationBody = [
                'title' => $modal->from_user == 1 ? $user->name : $vendor->business_name,
                'id' => $modal->id,
                'body' => $modal->message,
                'file' => $modal->file,
                'description' => '',
                'type' => 'message',
                'sound' => 'default',
                'fcm_device' => '',
                'livechat' => $modal->liveChat,
            ];

            $notification = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.get_static_option('vendor_firebase_server_key'),
            ])->post('https://fcm.googleapis.com/fcm/send', [
                'message' => [
                    'body' => 'subject',
                    'title' => 'title',
                ],
                'priority' => 'high',
                'data' => $notificationBody,
                'to' => $modal->from_user == 1 ? $vendor->firebase_device_token : $user->firebase_device_token,
            ]);
        });
    }
}
