<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'username' => ['required', 'string', 'min:3', 'max:25', Rule::unique('users', 'username')],
            'name'     => 'required|string|min:3|max:30',
            'email'    => ['nullable', 'string', 'max:191', Rule::unique('users', 'email')],
            'address'  => 'nullable|string|max:191',
            'zipcode'  => 'nullable|numeric|digits:5',
            'city'     => 'nullable|string|max:191',
            'state'    => 'nullable|string|max:191',
            'country'  => 'nullable|string|max:191',
            'phone'    => ['required', 'numeric', Rule::unique('users', 'phone')],
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
}
