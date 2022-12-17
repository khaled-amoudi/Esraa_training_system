<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\Group;
use App\Models\Semester;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){

        $teacher = User::teacher()->search(request()->query())->paginate(15);
        $teachers = UserResource::collection($teacher)->resolve();


        return view('dashboard', [
            'courses_count' => Course::count(),
            'groups_count' => Group::count(),
            'teachers_count' => User::teacher()->count(),
            'current_semester' => Semester::where('is_current_semester', 1)->first(),
            'teacher' => $teacher,
            'teachers' => $teachers,
        ]);
    }
}
