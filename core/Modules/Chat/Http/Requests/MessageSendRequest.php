<?php

namespace Modules\Chat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageSendRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "from_user" => "required",
            "message" => "nullable",
            "file" => "nullable|mimes:png,jpeg,jpg,gif,pdf",
            "product_id" => "nullable"
        ];
    }
}
