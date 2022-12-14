<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
            ],
            'description' => 'nullable',
            'image' => 'image|max:1048576',
            // 'slug' => '',
            'store_id' => 'integer|required|exists:stores,id',
            'category_id' => 'integer|required|exists:categories,id',
            'status' => 'required|in:active,archived,draft'
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attribute is required",
            'string' => ":attribute should contain alphbets",
            'unique' => ":attribute is already exists",
            'image' => "this feild should be of type image",
        ];
    }
}
