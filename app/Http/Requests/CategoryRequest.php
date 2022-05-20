<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CategoryRequest extends ApiFormRequest
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
            'category_name' => ['required', 'string', 'max:30', 'unique:categories'], 
            'description' => ['required', 'string', 'max:300'],
        ];
    }
}
