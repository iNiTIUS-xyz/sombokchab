<?php

namespace Modules\Refund\Entities;

    use Illuminate\Database\Eloquent\Model;
    
    class RefundTrackStatusReason extends Model
    {
        protected $fillable = [
            'request_track_id',
            'reason',
        ];
    }
