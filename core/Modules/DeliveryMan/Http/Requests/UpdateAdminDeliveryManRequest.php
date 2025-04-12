<?php

namespace Modules\DeliveryMan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminDeliveryManRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "identity_image" => "nullable|mimes:pdf,jpg,jpeg,gif,png",
            "driving_license_image" => "nullable|mimes:pdf,jpg,jpeg,gif,png",
            "profile_image" => "nullable|mimes:pdf,jpg,jpeg,gif,png",
            "password" => "nullable|confirmed|min:6",
            "vehicle_type" => "required|string",
            "delivery_zone" => "required|string",
            "delivery_man_type" => "required|string",
            "identity_number" => "required|string",
            "identity_type" => "required|string",
            "zone_id" => "required|string",
            "phone" => "required|string",
            "email" => "required|string|email|unique:delivery_mans,id," . $this->id,
            "last_name" => "required|string",
            "first_name" => "required|string",
            "license_number" => "nullable|string",
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

    protected function prepareForValidation()
    {
        return $this->merge([
            "zone_id" => $this->delivery_zone ?? null,
            "license_number" => $this->driving_license_number ?? null
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
