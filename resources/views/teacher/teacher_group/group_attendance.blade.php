@extends('Layouts.master')

@section('master')
    <div class="card mb-2">
        <div class="card-body">
            <form action="{{ route('teacher.student_attendances.store', $group->id) }}" method="POST">
                @csrf

                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">كشف دوام طلاب المجموعة</h5>
                    <button type="submit" class="btn btn-primary">حفظ الدوام</button>
                </div>
                <hr style="color: rgb(173, 173, 173)">
                <div class="filters my-4">
                    <div class="ms-auto position-relative">
                        <div class="row">
                            @if ($dates?->group_id == $group->id)
                                @foreach (json_decode($dates->dates) as $date)
                                    <div class="col-3 d-flex justify-content-center mb-2">
                                        <span class="mx-2 fw-bold">يوم <span
                                                class="text-primary">{{ $i++ }}</span></span>
                                        <input type="date" name="attendanceDate[]" value="{{ $date }}"
                                            @if ($group->attendance_state == 0) disabled @endif />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <hr style="opacity: .1">
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border text-center">الطالب</th>
                                @for ($i = 1; $i <= $attendance_days_count; $i++)
                                    <th class="border text-center">
                                        يوم {{ $i }}
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr class="bg-accent-on-hover {{ $loop->odd ? 'bg-accent' : '' }}">
                                    <td class="border text-center">{{ $student->name }}</td>
                                    @foreach (json_decode($student_attendances) as $attendance)
                                        @if ($student->id == $attendance->student_id && $attendance->course_id == $group->course->id)
                                            @foreach (json_decode($attendance->attendance) as $att)
                                                <td class="border text-center">
                                                    <select name="{{ $student->id }}attendance[]"
                                                        @if ($group->attendance_state == 0) disabled @endif>
                                                        <option @if ($att == null || $att == '') selected @endif
                                                            value=""></option>
                                                        <option @if ($att == '1') selected @endif
                                                            value="1">حضور</option>
                                                        <option @if ($att == '-1') selected @endif
                                                            value="-1">غياب</option>
                                                        <option @if ($att == '0') selected @endif
                                                            value="0">غياب بعذر</option>
                                                    </select>
                                                </td>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $attendance_days_count }}">
                                        <div class="text-secondary fw-bold pt-3 text-center">
                                            <img class="w-25 h-25" style="opacity: .8"
                                                src="{{ asset('admin/assets/images/no-data-3.svg') }}" alt="">
                                            <div class="my-3 fw-normal">لم يتم إضافة أي طالب لهذه المجموعة حتى الآن</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-end">
        <form action="{{ route('teacher.student_attendances.disable_group_attendance_state', $group->id) }}" method="POST">
            @csrf

            <a href="#" type="button" class="btn btn-sm btn-dark @if ($group->attendance_state == 0) disabled @endif"
                data-bs-toggle="modal" data-bs-target="#exampleModalActionFinalAttendance" data-bs-original-title="Show"
                aria-label="Show">
                تأكيد نهائي
            </a>
            <div class="modal fade" id="exampleModalActionFinalAttendance" tabindex="-1"
                aria-labelledby="exampleModalActionLabelFinalAttendance" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalActionLabelFinalAttendance">
                            </h5>
                            <button type="button" class="btn-close bg-danger text-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-3">

                            <h6>هل أنت متأكد من تأكيد دوام الطلاب بشكل نهائي ؟</h6>
                            <p>تأكيد دوام (حضور/غياب) الطلاب بشكل نهائي يؤدي إلى منعك من التعديل عليها لاحقا إلا من خلال التواصل مع
                                المسؤول ليمنحك الصلاحية</p>

                            <div>
                                <button type="button" class="btn btn-sm btn-cancel shadow-sm"
                                    data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit"
                                    class="btn btn-sm btn-dark @if ($group->attendance_state == 0) disabled @endif">
                                    <span class="mx-1">تأكيد بشكل النهائي</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
