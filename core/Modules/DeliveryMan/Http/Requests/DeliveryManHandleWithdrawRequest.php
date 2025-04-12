<?php

namespace Modules\DeliveryMan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryManHandleWithdrawRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "gateway_id" => "required",
            "gateway_fields" => "required",
            "amount" => "required",
            "delivery_man_id" => "required",
            "request_status" => "required"
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            "gateway_fields" => json_encode($this->gateway_fields),
            "delivery_man_id" => $this->type == 'api' ? auth()->user()->id : auth()->user()->id ?? null,
            "request_status" => "pending"
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
