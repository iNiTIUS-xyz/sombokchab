<?php

namespace Modules\Vendor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRegistrationRequest extends FormRequest {
    public function rules(): array {
        // dd(request()->all());
        return [
            "owner_name"       => "nullable",
            "username"         => "required|unique:vendors",
            "password"         => "required|confirmed|min:6",
            "business_name"    => "nullable",
            "business_type_id" => "nullable",
            "tax_id"           => "nullable|min:8|max:13",
            "description"      => "nullable",
            "status_id"        => "nullable",
            "phone"            => "nullable|unique:vendors",
            "email"            => "unique:vendors",
            "agree_terms"      => "required",
        ];
    }

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        return $this->merge([
            "business_type_id" => $this->business_type_id,
            "description"      => $this->message,
            "status_id"        => 2,
        ]);
    }
}
