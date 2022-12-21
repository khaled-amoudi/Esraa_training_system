<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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

    public function edit($id)
    {
        $model = User::find($id);
        if (!$model) {
            return redirect()->route('teacher')->with('fail', 'حدث خطأ أثناء المعالجة !!');
        }
        return view('teacher.edit', compact('model'));
    }


    public function update(Request $request, $id)
    {
        $model = User::find($id);
        if (!$model) {
            return redirect()->route('teacher')->with('fail', 'حدث خطأ أثناء المعالجة !!');
        }


        $password_validation = ['confirmed', Rules\Password::defaults()];
        $request->validate([
            'password' => isset($request->password) ? $password_validation : '',
        ]);

        $correct_old_password = Hash::check($request->old_password, $model->password) ? true : false;

        if ($correct_old_password) {
            $updated = $model->update([
                'password' => isset($request->password) ? Hash::make($request->password) : $model->password,
            ]);

            if ($updated) {
                return redirect()->route('teacher')->with('success', 'تم تحديث بيانات المدرب بنجاح');
            }
        } else {
            return redirect()->route('teacher.edit', $id)->with('fail', 'كلمة المرور القديمة غير صحيحة !!');
        }
    }


}
