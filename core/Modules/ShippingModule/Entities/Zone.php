<?php

namespace Modules\ShippingModule\Entities;

use App\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Modules\CountryManage\Entities\Country;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city_ids', 'country_id'];

    protected $casts = [
        'city_ids' => 'array',
    ];

    public function zoneCountry(): HasMany
    {
        return $this->hasMany(ZoneCountry::class, "zone_id", "id");
    }

    public function country()
    {
        return $this->hasManyThrough(Country::class, ZoneCountry::class, "zone_id", "id", "id", "country_id");
    }

    public function mrt_city()
    {
        return $this->hasOne(City::class, 'id', "city_id");
    }

    public function mrt_country()
    {
        return $this->hasOne(Country::class, 'id', "country_id");
    }

    public function getCityNamesAttribute(): string
    {
        $ids = $this->city_ids ?? [];
        if (empty($ids)) {
            return '';
        }

        return City::whereIn('id', $ids)->pluck('name')->implode(', ');
    }
}
