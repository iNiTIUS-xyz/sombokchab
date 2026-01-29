<?php

namespace Modules\ShippingModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingZoneRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            "zone_name" => "required",
            "city_ids" => "nullable|array",
            "city_ids.*" => "nullable|integer|exists:cities,id",
            "country_id" => "required"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
