<?php

namespace Modules\Refund\Entities;

use Illuminate\Database\Eloquent\Model;

class RefundDeductedAmount extends Model
{
    protected $fillable = [
        'reason',
        'amount',
        'refund_request_track_id',
    ];
}
