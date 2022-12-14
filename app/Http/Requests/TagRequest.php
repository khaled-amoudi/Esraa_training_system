<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:tags,name,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attribute is required",
            'string' => ":attribute should contain alphbets",
            'unique' => ":attribute is already exists",
        ];
    }
}
