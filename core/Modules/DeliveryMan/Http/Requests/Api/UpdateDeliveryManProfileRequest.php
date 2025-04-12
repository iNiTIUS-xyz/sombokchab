<?php

namespace Modules\DeliveryMan\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryManProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "identity_image" => "nullable|mimes:pdf,jpg,jpeg,gif,png",
            "driving_license_image" => "nullable|mimes:pdf,jpg,jpeg,gif,png",
            "profile_image" => "nullable|mimes:pdf,jpg,jpeg,gif,png",
            "vehicle_type" => "nullable|string",
            "delivery_zone" => "nullable|string",
            "delivery_man_type" => "nullable|string",
            "identity_number" => "nullable|string",
            "identity_type" => "nullable|string",
            "zone_id" => "nullable|string",
            "phone" => "nullable|string",
            "email" => "nullable|string|email|unique:delivery_mans,id," . auth()->user()->id,
            "last_name" => "nullable|string",
            "first_name" => "nullable|string",
            "license_number" => "nullable|string",
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
