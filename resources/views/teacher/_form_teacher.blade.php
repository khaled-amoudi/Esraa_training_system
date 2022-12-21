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
</div>
<hr class="hr p-0 mx-3 my-1">
<div class="card-body table-responsive p-4">
    <div class="row">

{{--        <x-BaseComponents.form.common.input type="text" name="name" :model="$model" label="إسم المدرب" placeholder="أدخل إسم المدرب" />--}}
{{--        <x-BaseComponents.form.common.input type="text" name="personalId" :model="$model" label="رقم الهوية الشخصية" placeholder="أدخل رقم الهوية الشخصية" />--}}

{{--        <x-BaseComponents.form.common.select_fixed name="role" :model="$model" label="اختر الدور"--}}
{{--        :options="[--}}
{{--            '0' => 'مدرب',--}}
{{--            '1' => 'أدمن',--}}
{{--        ]" />--}}

        <x-BaseComponents.form.common.password :cols="12" type="password" name="old_password" :model="$model" label="كلمة المرور القديمة" placeholder="كلمة المرور القديمة" />

        <x-BaseComponents.form.common.password :cols="12" type="password" name="password" :model="$model" label="كلمة المرور الجديدة" placeholder="كلمة المرور الجديدة" />

        <x-BaseComponents.form.common.password :cols="12" type="password" name="password_confirmation" :model="$model" label="تأكيد كلمة المرور الجديدة" placeholder="تأكيد كلمة المرور الجديدة" />


    </div>
</div>
