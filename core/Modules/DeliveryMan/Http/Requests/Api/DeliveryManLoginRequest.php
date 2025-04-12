<?php

namespace Modules\DeliveryMan\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryManLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required|min:6|max:30",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
