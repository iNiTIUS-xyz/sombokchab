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
            "name" => "required|string",
            "filed" => "nullable|string",
            "status_id" => "required|integer",
            "is_file" => "nullable",
        ];
    }

    protected function prepareForValidation()
    {
        $fields = [];

        if (isset($this->is_file) && $this->is_file == 'no') {

            foreach ($this->filed ?? [] as $key => $value) {
                $fields[$key] = SanitizeInput::esc_html($value);
            }
        }

        return $this->merge([
            "filed" => isset($this->is_file) && $this->is_file == 'no' ? serialize($fields) : null,
            "name" => SanitizeInput::esc_html($this->gateway_name),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
