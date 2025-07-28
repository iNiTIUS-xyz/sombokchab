<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "country_code" => [
                "required",
                "string"
            ],
            "otp_code" => [
                "required",
                "string"
            ],
            "phone" => [
                "required",
                "min:10",
                "max:15",
                "regex:/^\+?[0-9]+$/",
                Rule::unique('users', 'phone'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'otp_code.required' => 'The OTP code is required.',
            'otp_code.string' => 'The OTP code must be a valid string.',
            'phone.required' => 'The phone number is required.',
            'phone.min' => 'The phone number must be at least 10 digits.',
            'phone.max' => 'The phone number may not be greater than 15 digits.',
            'phone.regex' => 'The phone number format is invalid.',
            'phone.unique' => 'This phone number already been taken.',
        ];
    }
}
