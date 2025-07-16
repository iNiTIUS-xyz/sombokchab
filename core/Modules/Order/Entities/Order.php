<?php

namespace Modules\Order\Entities;

use App\Http\Traits\NotificationRelation;
use Illuminate\Database\Eloquent\Model;
use Modules\DeliveryMan\Entities\DeliveryManOrder;
use Modules\Refund\Entities\RefundRequest;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasEagerLimit, NotificationRelation;

    protected $fillable = [
        'coupon',
        'coupon_amount',
        'payment_track',
        'payment_gateway',
        'order_number',
        'transaction_id',
        'order_status',
        'payment_status',
        'invoice_number',
        'user_id',
        'type',
        'note',
        'selected_customer',
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->tracking_code = static::generateUniqueCode();
        });

    }

    protected static function generateUniqueCode()
    {
        do {
            $trackingCode = date('ymdhs');
        } while (Order::where('tracking_code', $trackingCode)->exists());

        return $trackingCode;
    }


    public function deliveryMan()
    {
        return $this->hasOne(DeliveryManOrder::class, 'order_id', 'id');
    }

    public function paymentMeta()
    {
        return $this->hasOne(OrderPaymentMeta::class, 'order_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id');
    }

    public function orderTrack()
    {
        return $this->hasMany(OrderTrack::class, 'order_id', 'id');
    }

    public function SubOrders()
    {
        return $this->hasMany(SubOrder::class, 'order_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasManyThrough(SubOrderItem::class, SubOrder::class, 'order_id', 'sub_order_id', 'id', 'id');
    }

    public function isDelivered()
    {
        return $this->hasOne(OrderTrack::class, 'order_id', 'id')->where('name', 'delivered');
    }

    public function isDeliveredStatus(): Attribute
    {
        return Attribute::get(fn() => $this->orderTrack()->where('name', 'delivered')->exists());
    }

    public function isCancelableStatus(): Attribute
    {
        return Attribute::get(function () {
            $orderTracks = $this->orderTrack()->pluck('name')->toArray();

            return in_array('ordered', $orderTracks) && count($orderTracks) === 1;
        });
    }

    public function refundRequest()
    {
        return $this->hasOne(RefundRequest::class, 'order_id', 'id');
    }

    public function hasRefundRequest(): Attribute
    {
        return Attribute::get(fn() => $this->refundRequest()->exists());
    }
}
