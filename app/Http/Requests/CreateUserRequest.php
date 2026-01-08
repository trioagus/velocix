<?php

namespace App\Http\Requests;

use Velocix\Validation\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            // 'field' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            // 'field.required' => 'Custom error message',
        ];
    }

    public function authorize()
    {
        return true;
    }
}