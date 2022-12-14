<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherAttendanceRequest extends FormRequest
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
            'user_id' => ['required'],
            'period' => ['required', 'in:صباحي,مسائي'],
            'group_id' => ['required', 'exists:groups,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'date' => ['required', 'date'],
            'leaving_time' => ['required', 'after:coming_time'],
            'coming_time' => ['required']
        ];
    }
}
