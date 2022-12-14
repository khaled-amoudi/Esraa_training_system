@extends('Layouts.master')

@section('master')
    <div class="mb-3">
        <div class="card p-2">
            @if(auth()->user()->attendance_state == 1)
            <form action="{{ route('teacher.teacher_attendance.store') }}" method="POST">
                @csrf

                <div class="row pt-1">
                    <x-BaseComponents.form.common.input cols="2" type="date" name="date" :model="$model" label="تاريخ الدوام" />

                    <x-BaseComponents.form.common.select_fixed cols="2" name="period" :model="$model"
                        label="فترة الدوام" :options="[
                            'صباحي' => 'صباحي',
                            'مسائي' => 'مسائي',
                        ]" />

                    <x-BaseComponents.form.common.select_dynamic cols="2" name="group_id" :model="$model"
                        label="المجموعة" :options="$additionalData['teacher_groups']" option_value_column="id" option_label_column="name" />

                    <x-BaseComponents.form.common.input cols="2" type="time" name="coming_time" label="وقت الحضور"
                        :model="$model" />

                    <x-BaseComponents.form.common.input cols="2" type="time" name="leaving_time" label="وقت المغادرة"
                        :model="$model" />

                    <input type="hidden" name="semester_id" value="{{ $current_semester->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


                    <div class="col-2">
                        <label class="form-label"></label>
                        <div><button type="submit" class="btn btn-primary mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                إضافة الدوام
                            </button></div>
                    </div>
                </div>
            </form>
            @else
                <span class="text-center">لإضافة أيام دوام جديدة, يرجى التواصل مع المسؤول ليمنحك الصلاحية 😑</span>
            @endif
        </div>
    </div>

    <x-BaseComponents.tabel.base-tabel :tabel_data="[
        'table_title' => 'كشف حصر الدوام',
    ]" :ths="['#', 'اليوم', 'المجموعة', 'التاريخ', 'وقت الحضور', 'وقت المغادرة', 'الفترة', 'الإجراءات']" :model="$model" :models="$models"
        :fillables="['day', 'group_id', 'date', 'coming_time', 'leaving_time']" :fillable_badges="[
            'period' => ['صباحي' => ['صباحي', 'alert-primary'], 'مسائي' => ['مسائي', 'alert-info']],
        ]" :actions="[
            // 'show_modal' => true,

            // 'route_show' => 'dashboard.course.show',
            // 'icon_class_show' => 'bi bi-eye-fill text-primary',

            // 'route_edit' => 'dashboard.course.edit',
            // 'icon_class_edit' => 'bi bi-pencil-fill text-warning',

            'route_destroy' => 'teacher.teacher_attendance.destroy',
            'icon_class_destroy' => 'bi bi-trash-fill text-danger',
        ]"
        :export_excel="['route_name' => 'teacher.teacher_attendance.exportExcel']"
        :export_pdf="['route_name' => 'teacher.teacher_attendance.exportPdf']"
        />

        <form action="{{ route('teacher.deactivate_teacher_attendance_permission', auth()->user()->id) }}" method="post">
            @csrf

            <button type="submit" class="btn btn-dark @if(auth()->user()->attendance_state == 0) disabled @endif">تأكيد نهائي</button>
        </form>

        @endsection
