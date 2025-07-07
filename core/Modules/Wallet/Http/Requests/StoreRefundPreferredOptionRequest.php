<?php

namespace Modules\Wallet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRefundPreferredOptionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "id" => "sometimes",
            "gateway_name" => ["required"],
            "filed" => ["nullable"],
            "status_id" => "required|integer",
            "is_file" => "nullable",
        ];
    }
}
