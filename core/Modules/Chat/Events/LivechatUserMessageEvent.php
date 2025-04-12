<?php

namespace Modules\Chat\Events;
use Illuminate\Broadcasting\InteractsWithSockets;use Illuminate\Broadcasting\PrivateChannel;use Illuminate\Contracts\Broadcasting\ShouldBroadcast;use Illuminate\Foundation\Events\Dispatchable;use Illuminate\Queue\SerializesModels;
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Entities\LiveChatMessage;

class LivechatUserMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private int $vendorId, $userId;
    public $message, $livechat, $messageBlade;

    public function __construct(string $messageBlade,$message, $livechat,$userId,$vendorId)
    {
        $this->messageBlade = $messageBlade;
        $this->message = $message;
        $this->livechat = $livechat;
        $this->vendorId = $vendorId;
        $this->userId = $userId;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('livechat-user-channel.' . $this->vendorId . '.' . $this->userId),
        ];
    }

    function broadcastAs(): string
    {
        return 'livechat-user-' . $this->userId;
    }
}
