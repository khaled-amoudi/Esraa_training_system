<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {

        $teacher = auth()->user();
        $groups = $teacher->groups;

        return view('teacher', [
            'groups' => $groups
        ]);
    }
}
