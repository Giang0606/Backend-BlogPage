<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class UserRequest extends ApiFormRequest
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
            'name' => ['string', 'max: 50', 'nullable'],
            'username_login' => ['required', 'string', 'max:255'], 
            'nickname' => ['string', 'max: 20', 'nullable'], 
            'birth_of_date' => ['date_format:Y-m-d','after_or_equal:1930-01-01', 'before:today', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['string', 'nullable'], 
            'phone_number' => ['digits:10', 'nullable'],
            'photo_url' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048', 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000', 'nullable'],
        ];
    }
}
