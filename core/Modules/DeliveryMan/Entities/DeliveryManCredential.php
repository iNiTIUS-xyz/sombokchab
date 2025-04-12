<?php

namespace Modules\DeliveryMan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryManCredential extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'delivery_man_id',
        'identity_type',
        'identity_number',
        'vehicle_type',
        'license_number',
        'identity_image',
        'license_image',
    ];

    public function deliveryMan(): BelongsTo
    {
        return $this->belongsTo(DeliveryMan::class, "delivery_man_id","id");
    }
}
