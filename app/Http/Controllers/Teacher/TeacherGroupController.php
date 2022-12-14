<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Base5Controller;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Http\Resources\StudentResource;
use App\Models\Group;
use App\Models\GroupAttendanceDay;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentGrade;
use Illuminate\Http\Request;

class TeacherGroupController extends Base5Controller
{

    public $route_view_name = "teacher.teacher_group";
    public $model = "App\\Models\\Group";
    public $resource = "App\Http\Resources\GroupResource";

    public function indexQuery()
    {
        return Group::where('user_id', auth()->user()->id)->search(request()->query())->paginate($this->paginate);
    }

    public function showAdditionalData($id)
    {
        $group = Group::find($id);
        $student = Student::search(request()->query())->paginate(25);
        $all_students = StudentResource::collection($student)->resolve();
        $students = $group->students;

        return [
            'student' => $student,
            'students' => $students,
            'all_students' => $all_students,
        ];
    }



    /////// Start Student Attendance & Store Student Attendance ////////
    public function student_attendances($group_id)
    {
        $group = Group::find($group_id);

        // تواريخ ايام الدوام اللي حيكون فوق الجدول
        $dates = GroupAttendanceDay::whereBelongsTo($group)->first();

        // عدد أيام الدوام مثلا = 8
        // $student_attendances = $group->student_attendances;
        $student_attendances = StudentAttendance::where('group_id', $group_id)->get(['student_id', 'course_id', 'attendance']);


        $attendance_days_count = $group->attendance_days;
        $students = $group->students;
        // $students_count = $group->students->count();

        return view('teacher.teacher_group.group_attendance', [
            'group' => $group,
            'dates' => $dates,
            'student_attendances' => $student_attendances,
            'attendance_days_count' => $attendance_days_count,
            'students' => $students,
            // 'students_count' => $students_count,
        ])->with('i', '1');
    }

    public function store_student_attendances(Request $request, $group_id)
    {
        $group = Group::find($group_id);
        $course = $group->course;
        $group_students = $group->students;


        // store the dates of days of group attendance
        $group_attendance = GroupAttendanceDay::where('group_id', $group->id);
        if ($group_attendance) {
            $group_attendance_dates = $group_attendance->updateOrCreate([
                'group_id' => $group->id
            ], [
                'group_id' => $group->id,
                'dates' => json_encode($request->input('attendanceDate')),
            ]);
        }

        // store the attendances of group students
        if ($group_students) {
            foreach ($group_students as $student) {
                $attendance = StudentAttendance::updateOrCreate([
                    'student_id' => $student->id,
                    'group_id' => $group->id,
                    'course_id' => $course->id
                ], [
                    'student_id' => $student->id,
                    'group_id' => $group->id,
                    'course_id' => $course->id,
                    'attendance' => json_encode($request->input($student->id . 'attendance')),
                ]);
            }
        }


        if ($attendance && $group_attendance_dates) {
            return redirect()->back()->with(['success' => 'تم تحديث الحضور والغياب لهذه المجموعة بنجاح ']);
        } else {
            return back()->withInput();
        }
    }

    public function disable_group_attendance_state($group_id)
    {
        $group = Group::find($group_id);
        if ($group)
            $disabled = $group->update(['attendance_state' => 0]);

        if ($disabled) {
            return redirect()->back()->with(['success' => 'تم تأكيد سجل الحضور والغياب للمجموعة بنجاح']);
        } else {
            return back()->withInput();
        }
    }
    /////// End Student Attendance & Store Student Attendance ////////



    /////// Start Student Grades & Store Student Grades ////////
    public function student_grades($group_id)
    {
        $group = Group::find($group_id);
        $course_id = $group->course->id;
        $students = $group->students;
        $grades = $group->student_grades;

        return view('teacher.teacher_group.group_grades', [
            'group' => $group,
            'course_id' => $course_id,
            'students' => $students,
            'grades' => $grades
        ])->with('i', 1);
    }

    public function store_student_grades(Request $request, $group_id)
    {
        $group = Group::find($group_id);
        $course = $group->course;
        $group_students = $group->students;

        foreach ($group_students as $student) {
            $student_grade = StudentGrade::where('student_id', $student->id)->where('course_id', $course->id)->where('semester_id', $course->semester_id);

            $store_grade = $student_grade->updateOrCreate([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'semester_id' => $course->semester_id
            ], [
                'student_id' => $student->id,
                'course_id' => $course->id,
                'group_id' => $group_id,
                'semester_id' => $course->semester_id,
                'grades' => json_encode($request->input($student->id . 'grades')),
            ]);
        }

        if ($store_grade) {
            return redirect()->back()->with(['success' => '✔️ تم تحديث الحضور والغياب لهذه المجموعة بنجاح ']);
        } else {
            return back()->withInput();
        }
    }

    public function disable_group_grades_state($group_id)
    {
        $group = Group::find($group_id);
        if ($group)
            $disabled = $group->update(['grades_state' => 0]);

        if ($disabled) {
            return redirect()->back()->with(['success' => 'تم تأكيد كشف درجات الطلاب للمجموعة بنجاح']);
        } else {
            return back()->withInput();
        }
    }



    // from Admin ( Activate & Diactivate Grades Status)
    public function group_grades_permission(Request $request, $group_id)
    {
        $group = Group::find($group_id);
        $group_grades_permission = $request->group_grades_permission;

        $group_grades_status = $group->update([
            'grades_state' => $group_grades_permission,
        ]);

        if (!$group_grades_status) {
            return redirect()->route('dashboard.group.show', $group_id)->with('fail', 'حدث خطأ أثناء المعالجة, حاول مرة أخرى !!');
        }
        return redirect()->route('dashboard.group.show', $group_id)->with('success', 'تم تغيير صلاحية درجات طلاب المجموعة بنجاح');
    }

    // from Admin ( Activate & Diactivate Attendance Status)
    public function group_attendance_permission(Request $request, $group_id)
    {
        $group = Group::find($group_id);
        $group_attendance_permission = $request->group_attendance_permission;

        $group_attendance_status = $group->update([
            'attendance_state' => $group_attendance_permission,
        ]);

        if (!$group_attendance_status) {
            return redirect()->route('dashboard.group.show', $group_id)->with('fail', 'حدث خطأ أثناء المعالجة, حاول مرة أخرى !!');
        }
        return redirect()->route('dashboard.group.show', $group_id)->with('success', 'تم تغيير صلاحية كشف الحضور والغياب لطلاب المجموعة بنجاح');
    }
}
