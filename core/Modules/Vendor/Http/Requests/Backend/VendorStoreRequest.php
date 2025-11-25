<?php

namespace Modules\Vendor\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorStoreRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "owner_name"         => "required|min:3|max:30|string",
            "username"           => "required|min:3|max:25|unique:vendors",
            "password"           => "required|confirmed|min:8",
            "business_name"      => "required|min:3|max:30|string",
            "business_type_id"   => "required",
            "description"        => "nullable",
            "logo_id"            => "nullable",
            "cover_photo_id"     => "nullable",
            "country_id"         => "required",
            "state_id"           => "required",
            "city_id"            => "required",
            "zip_code"           => "required|numeric|digits:5",
            "address"            => "nullable",
            "is_vendor_verified" => "nullable",
            "location"           => "nullable",
            "email"              => ["required", Rule::unique('vendors', 'email')->ignore($this->id)],
            "shop_email"         => "required",
            "number"             => ["required", Rule::unique('vendors', 'phone')->ignore($this->id)],
            "facebook_url"       => "nullable",
            "website_url"        => "nullable",
            "bank_name"          => "nullable",
            "bank_email"         => "nullable",
            "bank_code"          => "nullable|numeric",
            "account_number"     => "nullable|numeric",
        ];
    }

    public function authorize() {
        return true;
    }
}
