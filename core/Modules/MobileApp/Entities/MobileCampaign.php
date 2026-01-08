<?php

namespace Modules\MobileApp\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileCampaign extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_ids', 'limit'];

    protected function casts()
    {
        return [
            'campaign_ids' => 'json',
        ];
    }

    public $timestamps = false;
}
