@extends('Layouts.master')

{{-- @push('style')
<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endpush --}}
@section('master')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>مجموعة/ {{ $model['name'] }}</h5>
            <div class="d-flex justify-content-end m-0">
                <div class="group_students_attendance">
                    <a href="{{ route('teacher.student_grades', $model['id']) }}" class="btn btn-sm bg-gradient-amour text-white border-0 py-2">درجات الطلاب</a>
                </div>
                <div class="group_students_attendance ms-2">
                    <a href="{{ route('teacher.student_attendances', $model['id']) }}" class="btn btn-sm bg-gradient-amour text-white border-0 py-2">كشف دوام الطلاب</a>
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
                                        <input type="hidden" name="semester_id" value="{{ $current_semester->id }}">

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
                    $lists = [['label' => 'إسم المجموعة','attribute' => 'name',],['label' => 'رقم المجموعة','attribute' => 'group_number']];
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


    


@endsection



{{-- @push('script')
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/js/form-select2.js"></script>
@endpush --}}
