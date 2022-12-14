<div class="card-header border-0 d-flex justify-content-between align-items-center">
    <h5 class="card-title">{{ $form_title }}</h5>
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-cancel shadow-sm px-2 ms-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span>إلغاء</span>
        </a>
        <button type="submit" class="btn btn-primary shadow px-3 ms-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-check-square">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <span class="mx-1">حفظ</span>
        </button>
    </div>
    {{-- <button type="submit" class="btn btn-primary px-5">{{ str_word_count($form_title, 1)[0] ?? 'Save' }}</button> --}}
</div>
<hr class="hr p-0 mx-3 my-1">
<div class="card-body table-responsive p-4">
    <div class="row">

        <x-BaseComponents.form.common.input type="text" name="name" :model="$model" label="إسم المجموعة" placeholder="أدخل إسم المجموعة" />
        <x-BaseComponents.form.common.input type="text" name="group_number" :model="$model" label="رقم المجموعة" placeholder="أدخل رقم المجموعة" />

        <x-BaseComponents.form.common.select_dynamic name="course_id" :model="$model" label="المساق"
        :options="$additionalData['courses']" default_option="" option_value_column="id" option_label_column="name" />

        <x-BaseComponents.form.common.select_dynamic name="user_id" :model="$model" label="المدرب"
        :options="$additionalData['teachers']" default_option="" option_value_column="id" option_label_column="name" />

        <x-BaseComponents.form.common.input type="number" name="attendance_days" :model="$model" label="عدد أيام الدوام (بالأرقام)" placeholder="أدخل عدد أيام الدوام (بالأرقام)" />

    </div>
</div>
