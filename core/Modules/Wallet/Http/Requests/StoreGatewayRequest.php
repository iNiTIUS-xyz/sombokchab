<?php

namespace Modules\Wallet\Http\Requests;

use App\Helpers\SanitizeInput;
use Illuminate\Foundation\Http\FormRequest;

class StoreGatewayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "id" => "sometimes",
            "gateway_name" => "required|string",
            "filed" => "nullable",
            "status_id" => "required|integer",
            "is_file" => "nullable",
            "merchant_name" => "nullable",
            "merchant_id" => "nullable",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
