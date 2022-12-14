<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Base5Controller;
use App\Models\Semester;

class CourseController extends Base5Controller
{
    public $route_view_name = "dashboard.course";

    // public function createEditAdditionalData()
    // {
    //     $additionalData = Semester::get(['id', 'name']);
    //     return [
    //         'semesters' => $additionalData,
    //     ];
    // }

    // public function importRules()
    // {
    //     return [
    //         '*.name' => ['required', 'unique:categories'],
    //     ];
    // }
    // public function importCollection($row)
    // {
    //     return [
    //         'name' => $row['name'],
    //         'slug' => Str::slug($row['name']),
    //     ];
    // }
}
