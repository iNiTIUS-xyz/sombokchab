<?php

namespace Modules\DeliveryMan\Entities;

use App\Http\Traits\NotificationRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class DeliveryMan extends Model
{
    use HasApiTokens, NotificationRelation;
    use SoftDeletes, HasEagerLimit;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone',
        'profile_img',
        'password',
        'zone_id',
        'status',
        'delivery_man_type',
        'latitude',
        'longitude',
        'firebase_device_token',
        'verify_token',
        'email_verified'
    ];

    protected $hidden = [
        "password"
    ];

    public function ratings(): HasMany
    {
        return $this->hasMany(DeliveryManRating::class,"delivery_man_id","id");
    }

    public function credentials(): HasOne
    {
        return $this->hasOne(DeliveryManCredential::class,"delivery_man_id","id");
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(DeliveryManZone::class,"zone_id","id");
    }

    public function deliveryManOrder(): HasMany
    {
        return $this->hasMany(DeliveryManOrder::class,"delivery_man_id","id");
    }

    public function presentAddress(): HasOne
    {
        return $this->hasOne(DeliveryManPresentAddress::class,"delivery_man_id","id");
    }

    public function permanentAddress(): HasOne
    {
        return $this->hasOne(DeliveryManPermanentAddress::class,"delivery_man_id","id");
    }

    public function getFullNameAttribute(){
        if(str($this->last_name)->length() > 0){
            return $this->first_name . ' ' . $this->last_name;
        }

        return $this->first_name;
    }

    protected $table = "delivery_mans";
}
