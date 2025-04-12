<?php

namespace Modules\DeliveryMan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminDeliveryManStatusChangeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "id" => "required",
            "status" => "required"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
