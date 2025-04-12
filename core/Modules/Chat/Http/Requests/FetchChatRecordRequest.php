<?php

namespace Modules\Chat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchChatRecordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "user_id" => "required|exists:users,id",
            "vendor_id" => "required|exists:vendors,id",
            "product_id" => "nullable|exists:products,id",
            "from_user" => "required",
            "request_from" => "nullable"
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(
            $this->from_user == 1 ? ["user_id" => auth('web')->id(), "vendor_id" => (int) $this->vendor_id] :
                ["vendor_id" => auth('vendor')->id(),"user_id" => (int) $this->user_id]
            + ['from_user' => (int) $this->from_user == 1 ? 1 : 2]
        );
    }

    public function authorize(): bool
    {
        return true;
    }
}
