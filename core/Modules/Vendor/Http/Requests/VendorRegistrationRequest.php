<?php

namespace Modules\Vendor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Vendor\Entities\BusinessType;

class VendorRegistrationRequest extends FormRequest {
    public function rules(): array {
        // dd(request()->all());
        return [
            "owner_name"       => "nullable",
            "username"         => "required|unique:vendors|min:3|max:20",
            "password"         => "required|confirmed|min:8|max:25",
            "business_name"    => "nullable",
            "business_type_id" => "nullable",
            "passport_nid"     => "required",
            'tax_id'           => [
                'nullable',
                Rule::requiredIf(function () {
                    $btId = $this->input('business_type_id');
                    if (!$btId) {
                        return false;
                    }

                    $bt = BusinessType::find($btId);
                    return $bt && $bt->name === 'Business';
                }),
                'string',
                'regex:/^[A-Za-z]\d{12}$/',
            ],
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
