@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'المساقات المؤرشفة',
            'table_button_route' => 'dashboard.course.create'
        ]"

        :ths="['#', 'إسم المساق', 'رقم المساق', 'الفصل الدراسي', 'تاريخ الأرشفة', 'الدرجة العلمية', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['name', 'course_number', 'semester_id', 'deleted_at']"

        :fillable_badges="[
            'degree' => ['بكالوريس' => ['بكالوريس', 'alert-primary'], 'دبلوم' => ['دبلوم', 'alert-info']],
        ]"

        :actions="[
            'route_restore' => 'dashboard.course.restore',
            'icon_class_restore' => 'bx bx-history font-20',

            'route_force_delete' => 'dashboard.course.forceDelete',
            'icon_class_force_delete' => 'bi bi-trash-fill text-danger',

            // 'with_delete_group' => true,
        ]"

        :text_filters="[
            ['name' => 'name_courseNumber',           'label' => 'فلترة حسب إسم أو رقم المساق',         'cols' => '4'],
        ]"

        :select_fixed_filters="[
            [
                'name' => 'degree',
                'label' => 'الدرجة العلمية',
                'cols' => '3',
                'options' => [
                    [
                        'option_value' => 'بكالوريس',
                        'option_label' => 'بكالوريس',
                    ],
                    [
                        'option_value' => 'دبلوم',
                        'option_label' => 'دبلوم',
                    ],
                ]
            ],
        ]"

    />
@endsection

{{-- @push('script')
<script>
    $(function(e){
        $("#deletegroup").click(function(){
            $('.chechfordelete').prop('checked',$(this).prop('checked'));
        });
    })
</script>
@endpush --}}
