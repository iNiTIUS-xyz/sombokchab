<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_ids', 'limit', 'created_at', 'updated_at'];

    protected function casts()
    {
        return [
            'category_ids' => 'json',
        ];
    }

    public $timestamps = false;
}
