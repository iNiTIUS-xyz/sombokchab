<?php

namespace Modules\DeliveryMan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryManPickupPointRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'zone_id' => ['nullable', 'integer'],
            'vendor_id' => ['nullable', 'integer'],
            'country_id' => ['nullable', 'integer'],
            'state_id' => ['nullable', 'integer'],
            'city_id' => ['nullable', 'integer'],
            'zip_code' => ['nullable'],
            'address' => ['nullable'],
            'contact_number' => ['required'],
            'operating_hours' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
