<?php

namespace Modules\DeliveryMan\Entities;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Modules\CountryManage\Entities\Country;
    use Modules\CountryManage\Entities\State;

    class DeliveryManPresentAddress extends Model
{
    protected $fillable = [
        'delivery_man_id',
        'country_id',
        'state_id',
        'city_id',
        'zip_code',
        'address_one',
        'address_two',
    ];

    public $timestamps = false;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, "country_id", "id");
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, "state_id", "id");
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(State::class, "city_id", "id");
    }
}
