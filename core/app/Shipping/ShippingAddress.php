<?php

namespace App\Shipping;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Carbon;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use Modules\TaxModule\Entities\CountryTax;
use Modules\TaxModule\Entities\StateTax;

/**
 * App\Shipping\ShippingAddress
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $user_id
 * @property int|null $country_id
 * @property int|null $state_id
 * @property string|null $city
 * @property string|null $zip_code
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Country|null $country
 * @property-read State|null $state
 * @method static Builder|ShippingAddress newModelQuery()
 * @method static Builder|ShippingAddress newQuery()
 * @method static Builder|ShippingAddress query()
 * @method static Builder|ShippingAddress whereAddress($value)
 * @method static Builder|ShippingAddress whereCity($value)
 * @method static Builder|ShippingAddress whereCountryId($value)
 * @method static Builder|ShippingAddress whereCreatedAt($value)
 * @method static Builder|ShippingAddress whereEmail($value)
 * @method static Builder|ShippingAddress whereId($value)
 * @method static Builder|ShippingAddress whereName($value)
 * @method static Builder|ShippingAddress wherePhone($value)
 * @method static Builder|ShippingAddress whereStateId($value)
 * @method static Builder|ShippingAddress whereUpdatedAt($value)
 * @method static Builder|ShippingAddress whereUserId($value)
 * @method static Builder|ShippingAddress whereZipCode($value)
 * @mixin Eloquent
 */
class ShippingAddress extends Model
{
    protected $fillable = [
        'name',
        'email',
        'shipping_address_name',
        'phone',
        'user_id',
        'country_id',
        'state_id',
        'city',
        'zip_code',
        'address',
    ];

    public function get_states(): HasMany
    {
        return $this->hasMany(State::class, "country_id", "country_id");
    }
    public function get_cities(): HasMany
    {
        return $this->hasMany(City::class, "state_id", "state_id");
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function country_taxs(): HasOneThrough
    {
        return $this->hasOneThrough(
            CountryTax::class,      // Final model to retrieve (CountryTax)
            Country::class,        // Intermediate model (Country)
            'id',                  // Foreign key on the Country model (the 'id' column in Countries table)
            'country_id',       // Foreign key on the CountryTax model (the 'country_id' column in CountryTaxes table)
            'country_id',         // Local key on the ShippingAddress model (the 'country_id' column in ShippingAddresses table)
            'id'            // Local key on the Country model (the 'id' column in Countries table)
        )->select([
            'countries.name as name',
            'country_taxes.tax_percentage as tax_amount',
        ]);
    }
    public function state_taxs(): HasOneThrough
    {
        return $this->hasOneThrough(
            StateTax::class,      // Final model to retrieve (StateTax)
            State::class,        // Intermediate model (State)
            'id',               // Foreign key on the State model (the 'id' column in State table)
            'state_id',      // Foreign key on the StateTax model (the 'state_id' column in StateTaxes table)
            'state_id',        // Local key on the ShippingAddress model (the 'country_id' column in ShippingAddresses table)
            'id'          // Local key on the State model (the 'id' column in State table)
        )->select([
            'states.name as name',
            'state_taxes.tax_percentage as tax_amount',
        ]);
    }



    // state
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class, "city", "id");
    }
}
