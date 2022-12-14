<div class="card mb-2">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0">طلاب المجموعة</h5>
        </div>
        <hr style="color: rgb(173, 173, 173)">
        <div class="table-responsive mt-4">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>إسم الطالب</th>
                        <th>الرقم الجامعي</th>
                        <th>الدرجة العلمية</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="bg-accent-on-hover bg-accent">
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->university_number }}</td>
                            <td>
                                <span class="badge py-1 px-2 rounded-pill {{ $student->college == 'بكالوريس' ? 'alert-primary' : 'alert-info' }}"
                                    style="font-size: 12px; font-weight: 500;">
                                    {{ $student->college }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
