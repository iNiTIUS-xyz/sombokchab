<?php

namespace Modules\Vendor\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVendorRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "id"                 => "required",
            "owner_name"         => "required|min:3|max:30|string",
            "username"           => ["required", 'min:3', 'max:25', Rule::unique('vendors')->ignore($this->id)],
            "business_name"      => "required|min:3|max:30|string",
            "business_type_id"   => "required",
            "description"        => "nullable",
            "logo_id"            => "nullable",
            "cover_photo_id"     => "nullable",
            "country_id"         => "required",
            "state_id"           => "nullable",
            "city_id"            => "nullable",
            "zip_code"           => "nullable|numeric|digits:5",
            "is_vendor_verified" => "nullable",
            "address"            => "nullable",
            "location"           => "nullable",
            "email"              => ["nullable", Rule::unique('vendors', 'email')->ignore($this->id)],
            "number"             => ["nullable", Rule::unique('vendors', 'phone')->ignore($this->id)],
            "facebook_url"       => "nullable",
            "website_url"        => "nullable",
            "bank_name"          => "nullable",
            "bank_email"         => "nullable",
            "bank_code"          => "nullable|numeric",
            "account_number"     => "nullable|numeric",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
}
