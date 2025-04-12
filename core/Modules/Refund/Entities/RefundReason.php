<?php

namespace Modules\Refund\Entities;

use Illuminate\Database\Eloquent\Model;

class RefundReason extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
