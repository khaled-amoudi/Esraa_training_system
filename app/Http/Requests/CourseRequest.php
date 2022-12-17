<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'course_number' => ['required', Rule::unique('courses')->ignore($id)],
            'semester_id' => ['required', 'exists:semesters,id'],
            'degree' => ['required', 'in:بكالوريس,دبلوم']
        ];
    }
}
