<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0">درجات طلاب المجموعة</h5>
        </div>
        <hr style="color: rgb(173, 173, 173)">
        <div class="table-responsive mt-4">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center text-wrap">
                        <th>الإسم</th>
                        <th>الرقم الجامعي</th>
                        <th>Care Plan [20%]</th>
                        <th>Practice Exam [30%]</th>
                        <th>Nursing Competenncies [50%]</th>
                        <th class="text-info">Total [100%]</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($students as $student)
                        <tr class="text-center bg-accent-on-hover bg-accent">
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->university_number }}</td>
                            @foreach ($group_grades as $grade)
                                @if ($student->id == $grade->student_id)
                                    @foreach (json_decode($grade['grades']) as $stdgrades)
                                        <td>
                                            <span class="fw-bold text-dark-custom">{{ json_decode($stdgrades) }}</span>
                                        </td>
                                    @endforeach
                                    <td>
                                        <span
                                            class="fw-bold text-primary">{{ array_sum(json_decode($grade['grades'])) }}</span>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
