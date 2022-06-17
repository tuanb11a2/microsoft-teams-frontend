<?php

namespace Modules\UserApi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:users',
            'username' => 'required|unique:users',
            'phone_number' => 'required|unique:users',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users',
        ];
    }
}
