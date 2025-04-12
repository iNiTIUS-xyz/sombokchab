<?php

namespace Modules\Refund\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RefundRequestTrack extends Model
{
    protected $fillable = [
        'refund_request_id',
        'name',
        'updated_by',
        'table',
    ];

    protected $with = ["reason","deductedAmount"];

    public function refundRequest(): BelongsTo
    {
        return $this->belongsTo(RefundRequest::class,"refund_request_id","id");
    }

    public function reason(): HasMany
    {
        return $this->hasMany(RefundTrackStatusReason::class,"request_track_id","id");
    }

    public function deductedAmount(): HasMany
    {
        return $this->hasMany(RefundDeductedAmount::class,"refund_request_track_id","id");
    }
}
