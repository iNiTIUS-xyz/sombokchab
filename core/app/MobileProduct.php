<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_ids', 'limit', 'created_at', 'updated_at'];

    protected function casts()
    {
        return [
            'product_ids' => 'json',
        ];
    }

    public $timestamps = false;
}
