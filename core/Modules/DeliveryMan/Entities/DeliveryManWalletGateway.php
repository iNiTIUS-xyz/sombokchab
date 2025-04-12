<?php

namespace Modules\DeliveryMan\Entities;

    use App\Status;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class DeliveryManWalletGateway extends Model
    {
        protected $fillable = [
            'name',
            'fields',
            'status_id'
        ];

        public function status(): BelongsTo
        {
            return $this->belongsTo(Status::class);
        }
    }
