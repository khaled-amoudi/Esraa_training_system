<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Base5Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\GroupAttendanceDay;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentGrade;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GroupController extends Base5Controller
{
    public $route_view_name = "dashboard.group";



    public function createEditAdditionalData()
    {
        $additionalData = Course::get(['id', 'name']);
        $additionalData1 = User::teacher()->get(['id', 'name']);
        return [
            'courses' => $additionalData,
            'teachers' => $additionalData1,
        ];
    }


    public function setCreateResource($request)
    {
        return [
            'attendance_days' => $request->attendance_days ?? 8,
        ];
    }
    public function setUpdateResource($request, $old_image)
    {
        return [
            'attendance_days' => $request->attendance_days ?? 8,
        ];
    }

    //    public function setCreateUpdateResource($request, $old_image = null)
//    {
//        return [
//            'attendance_days' => $request->attendance_days != null ? $request->attendance_days : 8,
//        ];
//    }


    public function show($id)
    {
        $request = request();
        $object = $this->getModel()::find($id);
        $objectResource = $this->getResource($object);
        // $objectResource = new ($this->resource)($object);
        $model = $objectResource->resolve();
        $additionalData = $this->showAdditionalData($id);
        if (!$model) {
            return redirect()->route($this->route_index())->with('fail', $this->printModelText() . ' Doesn`t Exist');
        }

        $data['students'] = $object->students;

        if ($request->ajax()){
            if ($request->get('action-button') == 'attendance'){
                $data['group_attendance'] = StudentAttendance::where('group_id', $id)->get();
                $data['group_attendance_dates'] = GroupAttendanceDay::where('group_id', $id)->first();
                $html = view('dashboard.group.render.group-attendance', $data)->render();
            } elseif ($request->get('action-button') == 'grades'){
                $data['group_grades'] = StudentGrade::where('group_id', $id)->get();
                $html = view('dashboard.group.render.group-grades', $data)->render();
            } else {
                $html = view('dashboard.group.render.group-students', $data)->render();
            }
            return response()->json(compact('html'));
        }else
            return view($this->view_show(), compact('model', 'additionalData'));
    }




    public function saving($request, $model)
    {
        GroupAttendanceDay::updateOrCreate(
            ['group_id' => $model->id],
            [
                'group_id' => $model->id,
                'dates' => json_encode(array_fill(0, $model->attendance_days, "")),
            ]
        );
    }



    public function deleteRelations($model)
    {
        return GroupAttendanceDay::where('group_id', $model->id)->delete();
    }




    public function attach_student_to_group(Request $request)
    {
        $student = Student::find($request->student_id);
        $group = Group::find($request->group_id);
        $course_id = $group->course->id;
        $current_semester = Semester::where('is_current_semester', 1)->first()->id;

        try {
            DB::beginTransaction();

            $attachStudentToGroup = $group->students()->syncWithoutDetaching($student);


            // create student attendance object
            $thisStdGrade = StudentGrade::where('student_id', $student->id)->where('course_id', $course_id)->where('semester_id', $current_semester)->exists();
            if (!$thisStdGrade) {
                StudentGrade::create([
                    'student_id' => $request->student_id,
                    'course_id' => $course_id,
                    'group_id' => $request->group_id,
                    'semester_id' => $current_semester,
                    'grades' => json_encode(array("", "", "")),
                ]);
            }

            // create student attendance object
            StudentAttendance::create([
                'student_id' => $request->student_id,
                'course_id' => $course_id,
                'group_id' => $request->group_id,
                'attendance' => json_encode(array_fill(0, $group->attendance_days, "")),
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }


        if ($attachStudentToGroup) {
            return redirect()->back()->with(['success' => 'تم إضافة الطالب للمجموعة بنجاح ']);
        } else {
            return back()->withInput();
        }
    }

    public function detach_student_from_group($student_id, $group_id)
    {
        $student = Student::find($student_id);
        $group = Group::find($group_id);

        if (!$group) {
            return redirect()->back();
        } else {
            $group->students()->detach($student);
            StudentAttendance::where('student_id', $student_id)->where('group_id', $group_id)->delete();

            return redirect()->back()->with(['success' => 'تم حذف الطالب من المجموعة بنجاح ']);
        }
    }

    public function exportPdfHeadings()
    {
        return [
            'إسم المجموعة',
            'رقم المجموعة',
            'مساق المجموعة',
            'مدرب المجموعة',
            'عدد أيام الدوام'
        ];
    }
}
