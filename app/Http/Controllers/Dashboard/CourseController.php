<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Base5Controller;
use App\Models\Semester;

class CourseController extends Base5Controller
{
    public $route_view_name = "dashboard.course";


    public function exportHeadings()
    {
        return [
            'إسم المساق',
            'رقم المساق',
            'الكلية'
        ];
    }





    public function importRules()
    {
        return [
            '*.name' => ['required'],
            '*.course_number' => ['required', 'unique:courses'],
            '*.degree' => ['required', 'in:بكالوريس,دبلوم'],
        ];
    }
    public function importCollection($row)
    {
        return [
            'name' => $row['name'],
            'course_number' => $row['course_number'],
            'semester_id' => Semester::where('is_current_semester', 1)->first()->id,
            'degree' => $row['degree'],
        ];
    }
}
