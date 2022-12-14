@extends('Layouts.master')

@section('master')
    <x-BaseComponents.widgets.list_data :model="$model" title="عرض المدرب" :lists="[
        [
            'label' => 'إسم المدرب',
            'attribute' => 'name',
        ],
        [
            'label' => 'رقم الهوية الشخصية',
            'attribute' => 'personalId',
        ],
        [
            'type' => 'relation_many',
            'route' => 'dashboard.group.show',
            'label' => 'المجموعات',
            'attribute' => 'groups',
        ],
    ]" />



    <x-BaseComponents.tabel.base-tabel-relations :tabel_data="[
        'table_title' => 'كشف حصر الدوام للمدرب',
    ]" :ths="['#', 'اليوم', 'المجموعة', 'التاريخ', 'وقت الحضور', 'وقت المغادرة', 'الفترة']" :models="$model['teacherAttendances']" :fillables="['day', 'group_id', 'date', 'coming_time', 'leaving_time']"
        :fillable_badges="['period' => ['صباحي' => ['صباحي', 'alert-primary'], 'مسائي' => ['مسائي', 'alert-info']]]"
    >


    <div id="teacherAttendanceStatePermission">
        <a href="#" type="button" class="btn btn-sm bg-purple text-white" data-bs-toggle="modal"
            data-bs-target="#attendanceStateModalAction{{ $model['id'] }}" data-bs-original-title="attendanceState" aria-label="attendanceState">
            صلاحية حصر الدوام
        </a>
        <div class="modal fade" id="attendanceStateModalAction{{ $model['id'] }}" tabindex="-1"
            aria-labelledby="attendanceStateModalAction{{ $model['id'] }}Label" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="d-flex justify-content-center pb-4">
                        <form action="{{ route('dashboard.teacher_attendance_permission', $model['id']) }}" method="post">
                            @csrf
                            <div class="modal-body py-4">
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input class="form-check-input fs-4 mx-2" name="teacher_attendance_permission" type="checkbox" id="flexSwitchCheckDefault"
                                    @if ($model['attendance_state'] == 1)
                                        checked
                                    @endif>
                                    <label class="form-check-label fw-bold" style="color: rgb(21, 21, 21) !important;" for="flexSwitchCheckDefault">منح صلاحية التعديل على حصر الدوام للمدرب</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">
                                    إلغاء
                                </button>
                                <button type="submit" class="btn btn-primary">تأكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </x-BaseComponents.tabel.base-tabel-relations>
@endsection
