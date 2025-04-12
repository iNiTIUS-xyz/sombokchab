<?php

namespace Modules\Refund\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductInventoryDetail;

class RefundRequestProduct extends Model
{
    protected $fillable = [
        'refund_request_id',
        'product_id',
        'variant_id',
        'amount',
        'quantity',
        'reason_id',
        'other_reason',
    ];

    public function refundRequest(): BelongsTo
    {
        return $this->belongsTo(RefundRequest::class,"refund_request_id","id");
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,"product_id","id");
    }

    public function variant(): HasOne
    {
        return $this->hasOne(ProductInventoryDetail::class,"id","variant_id");
    }
}
