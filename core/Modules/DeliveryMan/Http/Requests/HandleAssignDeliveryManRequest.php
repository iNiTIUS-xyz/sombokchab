<?php

namespace Modules\DeliveryMan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleAssignDeliveryManRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "pickup_point_id" => "nullable",
            "delivery_man" => "required",
            "commission_type" => "nullable|string",
            "commission_amount" => "nullable|numeric|between:0,99.99",
            "date" => "required"
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            "date" => $this->date . ' ' . $this->time,
            "delivery_man" => $this->delivery_man_id
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
