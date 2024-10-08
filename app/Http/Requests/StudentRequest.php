<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
    public function rules($id = null)
    {
        return [
            'name' => ['required'],
            'university_number' => ['required', Rule::unique('students')->ignore($id)],
            'college' => ['required', 'in:بكالوريس,دبلوم'],
        ];
    }
}
