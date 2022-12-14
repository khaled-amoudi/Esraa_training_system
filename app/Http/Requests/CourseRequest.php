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
    public function rules()
    {
        return [
            'name' => ['required'],
            'course_number' => ['required', 'unique:'.Course::class],
            'semester_id' => ['required', 'exists:semesters,id'],
            'degree' => ['required', 'in:بكالوريس,دبلوم']
        ];
    }
}
