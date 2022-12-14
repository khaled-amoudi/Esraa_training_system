<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0">كشف دوام طلاب المجموعة</h5>
        </div>
        <hr style="color: rgb(173, 173, 173)">
        <div class="table-responsive mt-4">
            <table class="table align-middle mb-0 border">
                <thead class="table-light">
                    <tr class="text-center text-wrap border">
                        <th class="border">إسم الطالب</th>
                        <th class="border">الرقم الجامعي</th>
                        @if (isset($group_attendance_dates) && $group_attendance_dates != null)
                            @foreach (json_decode($group_attendance_dates->dates) as $date)
                                <th class="border">
                                    <span>{{ $date }}</span>
                                    <hr class="m-0">
                                    <span>{{ date('l', strtotime($date)) }}</span>
                                </th>
                            @endforeach
                        @endif

                    </tr>
                </thead>

                <tbody>
                    @foreach ($students as $student)
                        <tr class="text-center bg-accent-on-hover bg-accent border">
                            <td class="border">{{ $student->name }}</td>
                            <td class="border">{{ $student->university_number }}</td>
                            @foreach (json_decode($group_attendance) as $attendance)
                                @if ($student->id == $attendance->student_id)
                                    @foreach (json_decode($attendance->attendance) as $att)
                                        <td class="border">
                                            @if ($att == 1)
                                                <span class=" badge rounded-pill bg-success fw-bold">حضور</span>
                                            @elseif ($att == -1)
                                                <span class=" badge rounded-pill bg-danger fw-bold">غياب</span>
                                            @elseif ($att == 0)
                                                <span class=" badge rounded-pill bg-warning fw-bold">غياب بعذر</span>
                                            @else
                                                <span>...</span>
                                            @endif
                                        </td>
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
