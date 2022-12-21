<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Exports\BaseExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;

class UserController extends Controller
{

    public function __construct()
    {
        $this->model = new User();
        $this->resource = new UserResource(request());
    }

    public function index()
    {
        $model = $this->model->where('role', '0')->search(request()->query())->paginate(15);
        $models = $this->resource::collection($model)->resolve();
        return view('dashboard.teacher.index', compact('model', 'models'));
    }


    public function create()
    {
        $model = $this->model;
        return view('dashboard.teacher.create', compact('model'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:' . User::class],
            'personalId' => ['required', 'string', 'max:9', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $model = $this->model->create([
            'name' => $request->name,
            'personalId' => $request->personalId,
            'role' => $request->role ?? '0',
            'password' => Hash::make($request->password),
        ]);

        // PRG => Post Redirect Get
        if (!$model) {
            return redirect()->route('dashboard.teacher.index')->with('fail', 'حدث خطأ ما أثناء العملية !!');
        }
        return redirect()->route('dashboard.teacher.index')->with('success', 'تم إنشاء المدرب بنجاح');
    }


    public function show($id)
    {
        $object = $this->model->find($id);
        $objectResource = new UserResource($object);
        // $objectResource = new ($this->resource)($object);
        $model = $objectResource->resolve();
        if (!$model) {
            return redirect()->route('dashboard.teacher.index')->with('fail', 'المدرب غير موجود !!');
        }
        return view('dashboard.teacher.show', compact('model'));
    }



    public function edit($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return redirect()->route('dashboard.teacher.index')->with('fail', 'المدرب غير موجود !!');
        }
        return view('dashboard.teacher.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return redirect()->route('dashboard.teacher.index')->with('fail', 'المدرب غير موجود !!');
        }


        $password_validation = ['confirmed', Rules\Password::defaults()];
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'personalId' => ['required', 'string', 'max:9', Rule::unique('users')->ignore($id)],
            'password' => isset($request->password) ? $password_validation : '',
        ]);

        $updated = $model->update([
            'name' => $request->name,
            'personalId' => $request->personalId,
            'role' => $request->role ?? '0',
            'password' => isset($request->password) ? Hash::make($request->password) : $model->password,
        ]);

        if ($updated) {
            return redirect()->route('dashboard.teacher.index')->with('success', 'تم تحديث بيانات المدرب بنجاح');
        }
    }


    public function destroy($id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            return redirect()->route('dashboard.teacher.index')->with('fail', 'المدرب غير موجود !!');
        }
        $deleted = $model->delete();

        if ($deleted) // DO NOT check if the image was deleted, it will case an error
            return redirect()->route('dashboard.teacher.index')->with('success', 'تمت أرشفة المدرب بنجاح');
    }

    public function trash()
    {
        // ->withTrashed()  // this scope used to show all data with the soft deleted data also ..
        $model = $this->model->onlyTrashed()->search(request()->query())->paginate(15);
        $models = $this->resource::collection($model)->resolve();
        return view('dashboard.teacher.trash', compact('model', 'models'));
    }
    public function restore(Request $request, $id)
    {
        $model = $this->model->onlyTrashed()->findOrFail($id);
        $model->restore();  // make deleted_at = NULL
        return redirect()->route('dashboard.teacher.trash')->with('success', 'تم إستعادة بيانات المدرب بنجاح');
    }
    public function forceDelete($id)
    {
        $model = $this->model->onlyTrashed()->findOrFail($id);
        $model->forceDelete();

        ////////////////////////////////////////////////
        // DELETE RELATIONS [groups, students of groups]
        ////////////////////////////////////////////////

        return redirect()->route('dashboard.teacher.trash')->with('success', 'تم حذف المدرب بشكل نهائي بنجاح');
    }







    // Export Excel File
    public function exportExcelHeadings()
    {
        return $this->exportHeadings() ?? $this->exportCollection();
    }
    public function exportExcelCollection()
    {
        return $this->exportCollection();
    }
    public function exportExcel()
    {
        $headings = $this->exportExcelHeadings();
        $collection = $this->model->where('role', 0)->get($this->exportExcelCollection());
        // $collection = $this->resource::collection($this->exportExcelCollection())->collect();
        return Excel::download(new BaseExport($headings, $collection), 'teacher_.xlsx');
    }
    public function exportExcelDemo()
    {
        $headings = $this->exportExcelHeadings();
        $collection = collect(new $this->model);
        return Excel::download(new BaseExport($headings, $collection), 'teacher_demo.xlsx');
    }



    // Export PDF File
    public function exportPdfHeadings()
    { // set the headings of PDF to export
//        return $this->exportHeadings() ?? $this->exportCollection();
        return [
            'إسم المدرب',
            'رقم الهوية'
        ];
    }
    public function exportPdfCollection()
    { // set the collection of PDF to export
        return $this->exportCollection();
    }
    public function exportPdf()
    {
        $headings = $this->exportPdfHeadings();
        $collection_array = $this->exportPdfCollection();
        // $collection = $this->getModel()::get($this->exportPdfCollection());
        $collection = $this->resource::collection(User::where('role', 0)->get())->resolve();
        $pdf = LaravelMpdf::loadView('components.BaseComponents.tabel.export_templates.template_pdf', compact('collection', 'collection_array', 'headings'));
        return $pdf->stream('Teachers.pdf');
    }




    public function exportHeadings()
    {
        return [
            'إسم المدرب',
            'رقم الهوية'
        ];
    }
    public function exportCollection()
    {
        return !is_null(app(User::class)->getColumnsForSheets()) ? app(User::class)->getColumnsForSheets() : app(User::class)->getFillable();
    }
}
