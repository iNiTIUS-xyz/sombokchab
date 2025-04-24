<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetailsLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'trx_id',
    ];
}
