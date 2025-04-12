<?php

namespace Modules\DeliveryMan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Wallet\Entities\Wallet;

class DeliveryManWithdrawRequest extends Model
{
    protected $fillable = [
        'amount',
        'gateway_id',
        'delivery_man_id',
        'request_status',
        'gateway_fields',
        'note',
        'image',
    ];

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(DeliveryManWalletGateway::class,"gateway_id", "id");
    }

    public function deliveryMan(): BelongsTo
    {
        return $this->belongsTo(DeliveryMan::class,"delivery_man_id","id");
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, "delivery_man_id", "delivery_man_id");
    }
}
