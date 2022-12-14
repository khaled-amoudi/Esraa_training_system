@extends('Layouts.master')

@section('master')
    <x-BaseComponents.widgets.list_data :model="$model" title="عرض المجموعة" :lists="[
        [
            'label' => 'إسم المجموعة',
            'attribute' => 'name',
        ],
        [
            'label' => 'رقم المجموعة',
            'attribute' => 'group_number',
        ],
        [
            'label' => 'المدرب',
            'attribute' => 'teacher_id',
        ],
        [
            'label' => 'عدد طلاب المجموعة',
            'attribute' => 'group_students_number',
        ],
        [
            'label' => 'عدد أيام الدوام',
            'attribute' => 'attendance_days',
        ],
        [
            'label' => 'المساق',
            'attribute' => 'course_id',
        ],
        [
            'type' => 'badge',
            'label' => 'صلاحية التعديل على حصر دوام الطلاب',
            'attribute' => 'attendance_state_string',
            'class' => $model['attendance_state'] == 1 ? 'bg-gradient-success p-2' : 'bg-gradient-danger p-2',
        ],
        [
            'type' => 'badge',
            'label' => 'صلاحية التعديل على درجات لطلاب',
            'attribute' => 'grades_state_string',
            'class' => $model['grades_state'] == 1 ? 'bg-gradient-success p-2' : 'bg-gradient-danger p-2',
        ],
    ]">


        <div class="d-flex gap-1">
            <div id="groupAttendanceStatePermission">
                <a href="#" type="button" class="btn btn-sm bg-gradient-royal text-white" data-bs-toggle="modal"
                    data-bs-target="#groupAttendanceStateModalAction{{ $model['id'] }}"
                    data-bs-original-title="groupAttendanceState" aria-label="groupAttendanceState">
                    صلاحية حصر دوام الطلاب
                </a>
                <div class="modal fade" id="groupAttendanceStateModalAction{{ $model['id'] }}" tabindex="-1"
                    aria-labelledby="groupAttendanceStateModalAction{{ $model['id'] }}Label" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="d-flex justify-content-center pb-4">
                                <form action="{{ route('dashboard.group_attendance_permission', $model['id']) }}"
                                    method="post">
                                    @csrf
                                    <div class="modal-body py-4">
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input fs-4 mx-2" name="group_attendance_permission"
                                                type="checkbox" id="flexSwitchCheckDefault"
                                                @if ($model['attendance_state'] == 1) checked @endif>
                                            <label class="form-check-label fw-bold"
                                                style="color: rgb(21, 21, 21) !important;" for="flexSwitchCheckDefault">منح
                                                صلاحية التعديل على <span class="text-primary">حصر دوام</span> طلاب المجموعة
                                                بواسطة المدرب</label>
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


            <div id="groupGradesStatePermission">
                <a href="#" type="button" class="btn btn-sm bg-gradient-royal-2 text-white" data-bs-toggle="modal"
                    data-bs-target="#groupGradesStateModalAction{{ $model['id'] }}"
                    data-bs-original-title="groupGradesState" aria-label="groupGradesState">
                    صلاحية كشف حضور/غياب الطلاب
                </a>
                <div class="modal fade" id="groupGradesStateModalAction{{ $model['id'] }}" tabindex="-1"
                    aria-labelledby="groupGradesStateModalAction{{ $model['id'] }}Label" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="d-flex justify-content-center pb-4">
                                <form action="{{ route('dashboard.group_grades_permission', $model['id']) }}"
                                    method="post">
                                    @csrf
                                    <div class="modal-body py-4">
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input fs-4 mx-2" name="group_grades_permission"
                                                type="checkbox" id="flexSwitchCheckDefault"
                                                @if ($model['grades_state'] == 1) checked @endif>
                                            <label class="form-check-label fw-bold"
                                                style="color: rgb(21, 21, 21) !important;" for="flexSwitchCheckDefault">منح
                                                صلاحية التعديل <span class="text-primary">درجات</span> طلاب المجموعة بواسطة
                                                المدرب</label>
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

        </div>

    </x-BaseComponents.widgets.list_data>


    <hr class="my-4" style="color: rgb(173, 173, 173)">

    <div class="my-2">
        <button id="groupStudents" data-route="{{ route('dashboard.group.students', $model['id']) }}" class="btn btn-sm rounded-0 btn-outline-primary">طلاب المجموعة</button>
        <button id="groupAttendance" data-route="{{ route('dashboard.group.attendance', $model['id']) }}" class="btn btn-sm rounded-0 btn-outline-primary">حضور/غياب الطلاب</button>
        <button id="groupGrades" data-route="{{ route('dashboard.group.grades', $model['id']) }}" class="btn btn-sm rounded-0 btn-outline-primary">كشف درجات الطلاب</button>
    </div>

    <div id="group-details" class="shadow">
        <x-BaseComponents.tabel.base-tabel-relations :tabel_data="[
            'table_title' => 'طلاب المجموعة',
        ]" :ths="['#', 'إسم الطالب', 'الرقم الجامعي', 'الدرجة العلمية']" :models="$model['students']" :fillables="['name', 'university_number']"
            :fillable_badges="[
                'college' => ['بكالوريس' => ['بكالوريس', 'alert-primary'], 'دبلوم' => ['دبلوم', 'alert-info']],
            ]" />
    </div>
@endsection

@push('script')
    <script>
        (function($) {

            "use strict";

            $('#groupStudents').on('click', function() {
                var route = $(this).data('route');
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        "action-button": 'students'
                    },
                    datatype: "json",
                    success: function(response) {
                        $("#group-details").html(response.html);
                    },
                    error: function(error) {

                    },
                });
            });



            $('#groupAttendance').on('click', function() {
                var route = $(this).data('route');
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        "action-button": 'attendance'
                    },
                    datatype: "json",
                    success: function(response) {
                        $("#group-details").html(response.html);
                    },
                    error: function(error) {

                    },
                });
            });


            $('#groupGrades').on('click', function() {
                var route = $(this).data('route');
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        "action-button": 'grades'
                    },
                    datatype: "json",
                    success: function(response) {
                        $("#group-details").html(response.html);
                    },
                    error: function(error) {

                    },
                });
            });
        })(jQuery)
    </script>
@endpush
