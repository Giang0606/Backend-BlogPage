<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class LoginRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],  
        ];
    }

    public function message()
    {
        return [
            'email.required' => 'Please enter your email',
            'email.email' => 'Please ensure that your email address is correct',
            'password' => 'Please enter your password',
        ];
    }
}
