<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'course_id' => ['required', 'exists:courses,id'],
            'user_id' => ['required', 'exists:users,id'],
            'group_number' => ['required', Rule::unique('groups')->ignore(request()->get('id'))],
            // 'attendance_days',
            'attendance_state' => ['in:0,1', 'numeric'],
            'grades_state' => ['in:0,1', 'numeric'],
        ];
    }
}
