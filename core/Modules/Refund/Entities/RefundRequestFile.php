<?php

namespace Modules\Refund\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefundRequestFile extends Model
{
    protected $fillable = [
        'refund_request_id',
        'file',
    ];

    public function refundRequest(): BelongsTo
    {
        return $this->belongsTo(RefundRequest::class,"refund_request_id","id");
    }
}
