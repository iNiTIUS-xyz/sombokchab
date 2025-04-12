<?php

namespace Modules\DeliveryMan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryManZone extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'coordinates',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'integer'
    ];

    public function deliveryMan(): HasOne
    {
        return $this->hasOne(DeliveryMan::class, "zone_id", "id");
    }
}
