<?php

namespace Modules\Vendor\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "owner_name" => "required",
            "username" => "required|unique:vendors",
            "password" => "required|confirmed|min:8",
            "business_name" => "required",
            "business_type_id" => "required",
            "description" => "nullable",
            "logo_id" => "nullable",
            "cover_photo_id" => "nullable",
            "country_id" => "required",
            "state_id" => "required",
            "city_id" => "required",
            "zip_code" => "required",
            "address" => "nullable",
            "is_vendor_verified" => "nullable",
            "location" => "nullable",
            "email" => "nullable",
            "shop_email" => "required",
            "number" => "required",
            "facebook_url" => "nullable",
            "website_url" => "nullable",
            "bank_name" => "nullable",
            "bank_email" => "nullable",
            "bank_code" => "nullable",
            "account_number" => "nullable"
        ];
    }

    public function authorize()
    {
        return true;
    }
}
