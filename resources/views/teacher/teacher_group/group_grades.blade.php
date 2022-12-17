@extends('Layouts.master')

@section('master')
    <div class="card mb-2">
        <div class="card-body">
            <form action="{{ route('teacher.student_grades.store', $group->id) }}" method="POST">
                @csrf

                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">كشف درجات طلاب المجموعة</h5>
                    @if ($group->grades_state == 1)
                        <button type="submit" class="btn btn-primary">حفظ الدرجات</button>
                    @endif
                </div>

                <div class="table-responsive mt-3">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border text-center">#</th>
                                <th class="border text-center">إسم الطالب</th>
                                <th class="border text-center">الرقم الجامعي</th>
                                <th class="border text-center">Care Plan [20%]</th>
                                <th class="border text-center">Practice Exam [30%]</th>
                                <th class="border text-center">Nursing Competenncies [50%]</th>
                                <th class="border text-center text-info">Total [100%]</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="text-center">
                                    <td class="border">{{ $i++ }}</td>
                                    <td class="border">{{ $student->name }}</td>
                                    <td class="border">{{ $student->university_number }}</td>
                                    @foreach ($grades as $grade)
                                        @if ($student->id == $grade->student_id && $grade->course_id == $course_id)
                                            @foreach (json_decode($grade['grades']) as $student_grades)
                                                <td class="border"><input type="number"
                                                        value="{{ json_decode($student_grades) }}" style="width: 90px;" class="form-control p-0 ps-2 m-auto"
                                                        name="{{ $student->id }}grades[]" min="0"
                                                        @if ($group->grades_state == 0) disabled @endif
                                                        @if ($loop->first) max="20" @elseif ($loop->last) max="50" @else max="30" @endif>
                                                </td>
                                            @endforeach
                                            <td class="border"><input type="text" disabled class="w-50 p-0 m-0 text-center border-info"
                                                    value="{{ array_sum(json_decode($grade['grades'])) }}"></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-end">
        <form action="{{ route('teacher.student_attendances.disable_group_grades_state', $group->id) }}" method="POST">
            @csrf

            <a href="#" type="button" class="btn btn-sm btn-dark @if ($group->grades_state == 0) disabled @endif" data-bs-toggle="modal"
                data-bs-target="#exampleModalActionFinalGrades" data-bs-original-title="Show" aria-label="Show">
                إعتماد الدرجات
            </a>
            <div class="modal fade" id="exampleModalActionFinalGrades" tabindex="-1"
                aria-labelledby="exampleModalActionLabelFinalGrades" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalActionLabelFinalGrades">
                            </h5>
                            <button type="button" class="btn-close bg-danger text-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-3">

                            <h6>هل أنت متأكد من إعتماد درجات الطلاب بشكل نهائي ؟</h6>
                            <p>إعتماد درجات الطلاب بشكل نهائي يؤدي إلى منعك من التعديل عليها لاحقا إلا من خلال التواصل مع المسؤول ليمنحك الصلاحية</p>

                            <div>
                                <button type="button" class="btn btn-sm btn-cancel shadow-sm"
                                                                    data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-sm btn-dark @if ($group->grades_state == 0) disabled @endif">
                                    <span class="mx-1">تأكيد الإعتماد النهائي</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
