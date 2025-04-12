<?php

namespace Modules\DeliveryMan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Entities\User;

class DeliveryManRating extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'delivery_man_id',
        'user_id',
        'rating',
        'review',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
