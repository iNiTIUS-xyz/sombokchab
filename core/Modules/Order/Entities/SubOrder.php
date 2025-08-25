<?php

namespace Modules\Order\Entities;

use App\Http\Traits\NotificationRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductInventoryDetail;
use Modules\Vendor\Entities\Vendor;

class SubOrder extends Model
{
    use NotificationRelation;

    protected $fillable = [
        "order_id",
        "vendor_id",
        "total_amount",
        "shipping_cost",
        "tax_amount",
        "order_number",
        "payment_status",
        "order_status",
        "order_address_id",
        "tax_type"
    ];

    public function commission()
    {
        return $this->hasOne(SubOrderCommission::class, "sub_order_id", "id");
    }

    public function order()
    {
        return $this->hasOne(Order::class, "id", "order_id");
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class, "id", "vendor_id");
    }

    public function orderTrack()
    {
        return $this->hasMany(OrderTrack::class, "order_id", "order_id");
    }

    public function orderItem()
    {
        return $this->hasMany(SubOrderItem::class, "sub_order_id", "id");
    }

    public function product()
    {
        return $this->hasManyThrough(Product::class, SubOrderItem::class, "sub_order_id", "id", "id", "product_id");
    }

    public function productVariant()
    {
        return $this->hasManyThrough(ProductInventoryDetail::class, SubOrderItem::class, "sub_order_id", "id", "id", "variant_id");
    }
}
