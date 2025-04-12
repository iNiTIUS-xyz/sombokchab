<?php

namespace Modules\DeliveryMan\Entities;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class DeliveryManWalletGatewaySaved extends Model
    {
        protected $fillable = [
            'delivery_man_id',
            'delivery_man_gateway_id',
            'fields',
        ];

        protected $table = "delivery_man_wallet_gateway_saved";

        public function deliveryMan(): BelongsTo
        {
            return $this->belongsTo(DeliveryMan::class);
        }

        public function deliveryManGateway(): BelongsTo
        {
            return $this->belongsTo(DeliveryManWalletGateway::class);
        }
    }
