<?php

namespace Modules\Refund\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReasonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique("refund_reasons")->ignore($this->id ?? "")],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
