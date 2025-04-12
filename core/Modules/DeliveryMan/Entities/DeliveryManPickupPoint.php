<?php

namespace Modules\DeliveryMan\Entities;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Modules\CountryManage\Entities\City;
    use Modules\CountryManage\Entities\Country;
    use Modules\CountryManage\Entities\State;
    use Modules\Vendor\Entities\Vendor;

    class DeliveryManPickupPoint extends Model
    {
        use SoftDeletes;

        protected $fillable = [
            'name',
            'zone_id',
            'vendor_id',
            'country_id',
            'state_id',
            'city_id',
            'zip_code',
            'address',
            'contact_number',
            'operating_hours',
        ];

        public function zone(): BelongsTo
        {
            return $this->belongsTo(DeliveryManZone::class, "zone_id","id");
        }

        public function vendor(): BelongsTo
        {
            return $this->belongsTo(Vendor::class, "vendor_id","id");
        }

        public function country(): BelongsTo
        {
            return $this->belongsTo(Country::class, "country_id","id");
        }

        public function state(): BelongsTo
        {
            return $this->belongsTo(State::class, "state_id","id");
        }

        public function city(): BelongsTo
        {
            return $this->belongsTo(City::class, "city_id","id");
        }
    }
