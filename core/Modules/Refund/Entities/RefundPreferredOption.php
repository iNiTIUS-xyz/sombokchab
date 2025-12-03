<?php

namespace Modules\Refund\Entities;

use App\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefundPreferredOption extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'fields',
        'status_id',
        'is_file',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
