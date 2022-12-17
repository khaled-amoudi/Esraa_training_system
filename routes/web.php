<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\YearController;
use App\Http\Controllers\Dashboard\GroupController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\TeacherAttendanceController;
use App\Http\Controllers\Teacher\TeacherGroupController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});




// Route::get('/teacher', function(){
//     dd('welcome teacher');
// });
Route::get('/teacher', [TeacherController::class, 'index'])->middleware(['auth', 'verified'])->name('teacher');


$routes_all_teacher = [];
$routes_without_softdelete_export_import_teacher = [];
$routes_without_softdelete_teacher = [
    'teacher_attendance' => TeacherAttendanceController::class,
];

Route::name('teacher.')->prefix('/teacher')->middleware(['auth'])->group(function () {
    Route::resource('teacher_group', TeacherGroupController::class);

    // Students Attendances
    Route::get('teacher_group/{teacher_group}/student_attendances', [TeacherGroupController::class, 'show'])->name('student_attendances');
    Route::post('teacher_group/{teacher_group}/student_attendances/store', [TeacherGroupController::class, 'store_student_attendances'])->name('student_attendances.store');
    Route::post('teacher_group/{teacher_group}/student_attendances/disable_group_attendance_state', [TeacherGroupController::class, 'disable_group_attendance_state'])->name('student_attendances.disable_group_attendance_state');

    // Students Grades
    Route::get('teacher_group/{teacher_group}/student_grades', [TeacherGroupController::class, 'show'])->name('student_grades');
    Route::post('teacher_group/{teacher_group}/student_grades/store', [TeacherGroupController::class, 'store_student_grades'])->name('student_grades.store');
    Route::post('teacher_group/{teacher_group}/student_grades/disable_group_grades_state', [TeacherGroupController::class, 'disable_group_grades_state'])->name('student_attendances.disable_group_grades_state');

    // Deactivate Teacher Attendance Permission
    Route::post('teacher/deactivate-teacher-attendance-permission/{teacher_id}', [TeacherAttendanceController::class, 'deactivate_teacher_attendance_permission'])->name('deactivate_teacher_attendance_permission');

    // Attach & Detach Student to/from Group
    Route::post('teacher/attach-student-to-group', [GroupController::class, 'attach_student_to_group'])->name('attach_student_to_group');
    Route::delete('teacher/detach-student-from-group/{student_id}/{group_id}', [GroupController::class, 'detach_student_from_group'])->name('detach_student_from_group');
});

foreach ($routes_all_teacher as $route_name => $route_controller) {
    Route::controller($route_controller)->name('teacher.')->prefix('/teacher')->middleware(['auth'])->group(function () use ($route_name, $route_controller) {
        Route::get($route_name . '/export-excel/', 'exportExcel')->name($route_name . '.exportExcel');
        Route::get($route_name . '/export-excel-demo/', 'exportExcelDemo')->name($route_name . '.exportExcelDemo');
        Route::get($route_name . 'export-pdf/', 'exportPdf')->name($route_name . '.exportPdf');
        Route::post($route_name . 'import-excel/', 'importExcel')->name($route_name . '.importExcel');

        Route::get($route_name . '-trash', 'trash')->name($route_name . '.trash');
        Route::put($route_name . '/{category}/restore', 'restore')->name($route_name . '.restore');
        Route::delete($route_name . '/{category}/force-delete', 'forceDelete')->name($route_name . '.forceDelete');
        // Route::delete($route_name.'/force-group-delete', 'deleteGroup')->name($route_name.'.deleteGroup');

        Route::resource($route_name, $route_controller);
    });
}

foreach ($routes_without_softdelete_export_import_teacher as $route_name => $route_controller) {
    Route::controller($route_controller)->name('teacher.')->prefix('/teacher')->middleware(['auth'])->group(function () use ($route_name, $route_controller) {
        Route::resource($route_name, $route_controller);
    });
}

foreach ($routes_without_softdelete_teacher as $route_name => $route_controller) {
    Route::controller($route_controller)->name('teacher.')->prefix('/teacher')->middleware(['auth'])->group(function () use ($route_name, $route_controller) {
        Route::get($route_name . '/export-excel/', 'exportExcel')->name($route_name . '.exportExcel');
        Route::get($route_name . '/export-excel-demo/', 'exportExcelDemo')->name($route_name . '.exportExcelDemo');
        Route::get($route_name . 'export-pdf/', 'exportPdf')->name($route_name . '.exportPdf');
        Route::post($route_name . 'import-excel/', 'importExcel')->name($route_name . '.importExcel');
        Route::resource($route_name, $route_controller);
    });
}








///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'isAdmin'])->name('dashboard');


Route::name('dashboard.')->prefix('/dashboard')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::post('/teacher-attendance-permission/{teacher_id}', [TeacherAttendanceController::class, 'teacher_attendance_permission'])->name('teacher_attendance_permission');
    Route::post('/group-attendance-permission/{teacher_id}', [TeacherGroupController::class, 'group_attendance_permission'])->name('group_attendance_permission');
    Route::post('/group-grades-permission/{teacher_id}', [TeacherGroupController::class, 'group_grades_permission'])->name('group_grades_permission');
});



$routes_all = [
    'course' => CourseController::class,
    'group' => GroupController::class,
    'teacher' => UserController::class,
];
$routes_without_softdelete_export_import = [
    'year' => YearController::class,
];
$routes_student = [
    'student' => StudentController::class,
];
// $routes_without_softdelete = [
// ];


Route::name('dashboard.')->prefix('/dashboard')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('group/{group_id}/grades', [GroupController::class, 'show'])->name('group.grades');
    Route::get('group/{group_id}/attendance', [GroupController::class, 'show'])->name('group.attendance');
    Route::get('group/{group_id}/students', [GroupController::class, 'show'])->name('group.students');
});


foreach ($routes_all as $route_name => $route_controller) {
    Route::controller($route_controller)->name('dashboard.')->prefix('/dashboard')->middleware(['auth', 'isAdmin'])->group(function () use ($route_name, $route_controller) {
        Route::get($route_name . '/export-excel/', 'exportExcel')->name($route_name . '.exportExcel');
        Route::get($route_name . '/export-excel-demo/', 'exportExcelDemo')->name($route_name . '.exportExcelDemo');
        Route::get($route_name . 'export-pdf/', 'exportPdf')->name($route_name . '.exportPdf');
        Route::post($route_name . 'import-excel/', 'importExcel')->name($route_name . '.importExcel');

        Route::get($route_name . '-trash', 'trash')->name($route_name . '.trash');
        Route::put($route_name . '/{category}/restore', 'restore')->name($route_name . '.restore');
        Route::delete($route_name . '/{category}/force-delete', 'forceDelete')->name($route_name . '.forceDelete');
        // Route::delete($route_name.'/force-group-delete', 'deleteGroup')->name($route_name.'.deleteGroup');

        Route::resource($route_name, $route_controller);
    });
}

foreach ($routes_without_softdelete_export_import as $route_name => $route_controller) {
    Route::controller($route_controller)->name('dashboard.')->prefix('/dashboard')->middleware(['auth', 'isAdmin'])->group(function () use ($route_name, $route_controller) {
        Route::resource($route_name, $route_controller);
    });
}

foreach ($routes_student as $route_name => $route_controller) {
    Route::controller($route_controller)->name('dashboard.')->prefix('/dashboard')->middleware(['auth', 'isAdmin'])->group(function () use ($route_name, $route_controller) {
        Route::get($route_name . '/export-excel/', 'exportExcel')->name($route_name . '.exportExcel');
        Route::get($route_name . '/export-excel-demo/', 'exportExcelDemo')->name($route_name . '.exportExcelDemo');
        Route::get($route_name . 'export-pdf/', 'exportPdf')->name($route_name . '.exportPdf');
        Route::post($route_name . 'import-excel/', 'importExcel')->name($route_name . '.importExcel');
        Route::resource($route_name, $route_controller)->except(['show', 'edit', 'update']);
    });
}




///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////




// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


require __DIR__ . '/auth.php';
