<?php

namespace Modules\DeliveryMan\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PresentAndPermanentAddressUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "present_country_id" => "required|string",
            "present_state_id" => "nullable|string",
            "present_city_id" => "nullable|string",
            "present_zip_code" => "nullable|string",
            "present_address_one" => "nullable|string",
            "present_address_two" => "nullable|string",
            "permanent_country_id" => "required|string",
            "permanent_state_id" => "nullable|string",
            "permanent_city_id" => "nullable|string",
            "permanent_zip_code" => "nullable|string",
            "permanent_address_one" => "nullable|string",
            "permanent_address_two" => "nullable|string"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
