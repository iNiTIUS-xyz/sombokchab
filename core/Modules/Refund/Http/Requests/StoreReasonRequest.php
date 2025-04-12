<?php

namespace Modules\Refund\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReasonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','unique:refund_reasons'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
