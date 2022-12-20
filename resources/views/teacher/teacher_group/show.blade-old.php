@extends('Layouts.master')

@push('style')
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('master')
    <div class="card mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>مجموعة/ {{ $model['name'] }}</h5>
            <div class="d-flex justify-content-end m-0">
                <div class="group_students_attendance me-2">
                    <button id="student_attendances" data-route="{{ route('teacher.student_attendances', $model['id']) }}"
                        class="btn btn-sm bg-gradient-amour text-white border-0 py-2">
                        كشف دوام الطلاب
                    </button>
                </div>
                <div class="group_students_attendance">
                    <button id="student_grades" data-route="{{ route('teacher.student_grades', $model['id']) }}"
                        class="btn btn-sm bg-gradient-amour text-white border-0 py-2">
                        درجات الطلاب
                    </button>
                </div>

                <div class="assign_student_to_group ms-2">
                    <button type="button" class="btn btn-sm bg-purple border-0 py-2 text-white" data-bs-toggle="modal"
                        data-bs-target="#assignStudentToGroupModal">إضافة طالب للمجموعة +</button>
                    <!-- Modal -->
                    <div class="modal fade" id="assignStudentToGroupModal" tabindex="-1"
                        aria-labelledby="assignStudentToGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('teacher.attach_student_to_group') }}" method="post">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="assignStudentToGroupModalLabel">إضافة طالب جديد لهذه
                                            المجموعة
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- <div class="mb-3">
                                            <label class="form-label">إختر طالب لإضافته للمجموعة</label>
                                            <select class="single-select">
                                                @foreach ($additionalData['all_students'] as $student)
                                                    <option value="{{ $student['id'] }}">
                                                        {{ $student['university_number'] . ' - ' . $student['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}

                                        <label for="student_id" class="form-label">إختر طالب لإضافته للمجموعة</label>
                                        <select class="form-select form-select-sm" id="student_id" name="student_id"
                                            aria-label=".form-select-sm example">
                                            <option selected></option>
                                            @foreach ($additionalData['all_students'] as $student)
                                                <option value="{{ $student['id'] }}">
                                                    {{ $student['university_number'] . ' - ' . $student['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="group_id" value="{{ $model['id'] }}">
                                        <input type="hidden" name="semester_id" value="{{ $current_semester?->id }}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn bg-purple text-white">تأكيد إضافة الطالب</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row p-0 m-0">
                @php
                    $lists = [['label' => 'إسم المجموعة', 'attribute' => 'name'], ['label' => 'رقم المجموعة', 'attribute' => 'group_number'], ['label' => 'المساق', 'attribute' => 'course_id'], ['label' => 'عدد طلاب المجموعة', 'attribute' => 'group_students_number']];
                @endphp
                @foreach ($lists as $list)
                    <div class="col-12 col-md-6 border p-2 d-flex align-items-center">
                        <div class="row w-100 ">
                            <div class="col-4 d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ $list['label'] }}</span>
                                <span>:</span>
                            </div>
                            <div class="col-8 d-flex justify-content-between align-items-center p-0">
                                <span>{{ $model[$list['attribute']] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div id="group-details">
        @include('teacher.teacher_group.render.render_student_attendance')
    </div>
@endsection


@push('script')
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/form-select2.js') }}"></script>


    <script>
        (function($) {

            "use strict";

            $('#student_grades').on('click', function() {
                var route = $(this).data('route');
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        "action-button": 'student_grades'
                    },
                    datatype: "json",
                    success: function(response) {
                        console.log('student_grades', response);
                        $("#group-details").html(response.html);
                    },
                    error: function(error) {},
                });
            });


            $('#student_attendances').on('click', function() {
                var route = $(this).data('route');
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        "action-button": 'student_attendances'
                    },
                    datatype: "json",
                    success: function(response) {
                        console.log('student_attendances', response);
                        $("#group-details").html(response.html);
                    },
                    error: function(error) {},
                });
            });
        })(jQuery)
    </script>
@endpush
