<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Base5Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherAttendanceController extends Base5Controller
{
    public $route_view_name = "teacher.teacher_attendance";


    public function indexQuery()
    {
        return $this->getModel()::search(request()->query())->latest()->paginate($this->paginate);
    }


    public function indexAdditionalData()
    {
        // $auth_id = auth()->user();
        // $teacher_groups = Group::whereBelongsTo($auth_id)->get(['id', 'name']);
        $auth_id = auth()->user()->id;
        $teacher_groups = Group::where('user_id', $auth_id)->get(['id', 'name']);
        $teacher_attendance_state = User::whereId($auth_id)->get(['attendance_state']);
        // dd($teacher_attendance_state);
        return [
            'teacher_groups' => $teacher_groups,
            'teacher_attendance_state' => $teacher_attendance_state
        ];
    }


    public function store(Request $request)
    {
        $request->validate($this->getRequest()->rules(), $this->getRequest()->messages());

        $teacher = User::find(auth()->user()->id);
        if ($teacher->attendance_state == 1) {
            $model = $this->getModel()::create($this->setCreateAttributes($request));

            if ($model)
                $this->afterCreate($request, $model);

            if (!$model) {
                return redirect()->route($this->route_index())->with('fail', 'حدث خطأ في عملية إضافة دوام جديد !!');
            }
            return redirect()->route($this->route_index())->with('success', 'تم إضافة دوام جديد بنجاح');
        } else {
            return redirect()->route($this->route_index());
        }
    }




    // from Teacher (Diactivate Status)
    public function deactivate_teacher_attendance_permission($teacher_id)
    {
        $teacher = User::find($teacher_id);

        // $deactiveate_status = DB::update('update users set attendance_state = 0 where id = ?', [$teacher->id]);
        $deactiveate_status = $teacher->update([
            'attendance_state' => 0,
        ]);

        if (!$deactiveate_status) {
            return redirect()->route($this->route_index())->with('fail', 'Something Went Wrong !!');
        }
        return redirect()->route($this->route_index())->with('success', 'Teacher Attendance Status De-Activated Successfully');
    }




    // from Admin ( Activate & Diactivate Status)
    public function teacher_attendance_permission(Request $request, $teacher_id)
    {
        $teacher = User::find($teacher_id);
        $teacher_attendance_permission = $request->teacher_attendance_permission;

        $teacher_attendance_status = $teacher->update([
            'attendance_state' => $teacher_attendance_permission,
        ]);

        if (!$teacher_attendance_status) {
            return redirect()->route('dashboard.teacher.show', $teacher_id)->with('fail', 'حدث خطأ أثناء المعالجة, حاول مرة أخرى !!');
        }
        return redirect()->route('dashboard.teacher.show', $teacher_id)->with('success', 'تم تغيير صلاحية حصر الدوام للمدرب بنجاح');
    }


    public function exportHeadings()
    {
        return [
            'إسم المدرب',
            'الفترة',
            'المجموعة',
            'التاريخ',
            'وقت الحضور',
            'وقت المغادرة'
        ];
    }
}
