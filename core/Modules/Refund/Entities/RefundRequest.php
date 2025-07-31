<?php

namespace Modules\Refund\Entities;

use App\Http\Traits\NotificationRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\SubOrderItem;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductInventoryDetail;
use Modules\User\Entities\User;

class RefundRequest extends Model
{
    use NotificationRelation;

    protected $fillable = [
        'order_id',
        'additional_information',
        'preferred_option_id',
        'preferred_option_fields',
        'refund_fee',
        'qr_file',
        'status',
        'user_id'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, "order_id", "id");
    }

    public function preferredOption(): BelongsTo
    {
        return $this->belongsTo(RefundPreferredOption::class, "preferred_option_id", "id");
    }

    public function requestProduct(): HasMany
    {
        return $this->hasMany(RefundRequestProduct::class, "refund_request_id", "id");
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, RefundRequestProduct::class, "refund_request_id", "id", "id", "product_id");
    }

    public function requestFile(): HasMany
    {
        return $this->hasMany(RefundRequestFile::class, "id", "refund_request_id");
    }

    public function requestTrack(): HasMany
    {
        return $this->hasMany(RefundRequestTrack::class, "refund_request_id", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function productVariant(): HasManyThrough
    {
        return $this->hasManyThrough(ProductInventoryDetail::class, RefundRequestProduct::class, "refund_request_id", "id", "id", "variant_id");
    }

    public function currentTrackStatus(): HasOne
    {
        return $this->hasOne(RefundRequestTrack::class, "refund_request_id", "id")->orderByDesc("refund_request_tracks.id");
    }
}
