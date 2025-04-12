<?php

namespace Modules\DeliveryMan\Entities;

use App\Http\Traits\NotificationRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderPaymentMeta;
use Modules\Order\Entities\OrderTrack;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class DeliveryManOrder extends Model
{
    use HasEagerLimit, NotificationRelation;

    protected $fillable = [
        'delivery_man_id',
        'order_id',
        'pickup_point_id',
        'payment_type',
        'total_amount',
        'commission_type',
        'commission_amount',
        'delivery_date',
        'created_by',
        'updated_by',
        'created_by_type',
        'updated_by_type'
    ];

    public function orderPaymentMeta(): BelongsTo
    {
        return $this->belongsTo(OrderPaymentMeta::class, "order_id","order_id");
    }

    public function deliveryManRatting(): HasOneThrough
    {
        return $this->hasOneThrough(DeliveryManRating::class,DeliveryMan::class,"id","delivery_man_id","delivery_man_id","id");
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,"order_id", "id");
    }

    public function orderTrack(): BelongsToMany
    {
        return $this->belongsToMany(OrderTrack::class, Order::class,"id","id", "order_id","order_id");
    }

    public function deliveryMan(): BelongsTo
    {
        return $this->belongsTo(DeliveryMan::class, "delivery_man_id","id");
    }

    public function pickupPoint(): BelongsTo
    {
        return $this->belongsTo(DeliveryManPickupPoint::class, "pickup_point_id","id");
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
