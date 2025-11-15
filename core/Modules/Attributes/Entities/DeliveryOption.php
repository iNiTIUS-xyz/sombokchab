<?php

namespace Modules\Attributes\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "icon",
        "title",
        "sub_title",
        "title_km",
        "sub_title_km"
    ];

    protected static function newFactory()
    {
        return \Modules\Attributes\Database\factories\DeliveryOptionFactory::new();
    }
}
