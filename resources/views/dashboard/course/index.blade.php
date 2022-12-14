@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'المساقات',
            'table_button_route' => 'dashboard.course.create']"

        :ths="['#', 'إسم المساق', 'رقم المساق', 'الفصل الدراسي', 'الدرجة العلمية', 'مجموعات المساق', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['name', 'course_number', 'semester_id']"
        :fillable_badges="[
            'degree' => ['بكالوريس' => ['بكالوريس', 'alert-primary'], 'دبلوم' => ['دبلوم', 'alert-info']],
        ]"

        :fillables_relation_many_groups="['groups']"


        :actions="[
            // 'show_modal' => true,
            'route_show' => 'dashboard.course.show',
            'icon_class_show' => 'bi bi-eye-fill text-primary',

            'route_edit' => 'dashboard.course.edit',
            'icon_class_edit' => 'bi bi-pencil-fill text-warning',

            'route_destroy' => 'dashboard.course.destroy',
            'icon_class_destroy' => 'bi bi-trash-fill text-danger',
            'with_soft_delete' => true,
        ]"

        :export_excel="['route_name'=>'dashboard.course.exportExcel']"
        :export_excel_demo="['route_name'=>'dashboard.course.exportExcelDemo']"
        :export_pdf="['route_name'=>'dashboard.course.exportPdf']"
        :import_excel="['route_name'=>'dashboard.course.importExcel']"

        :text_filters="[
            ['name' => 'name_courseNumber',           'label' => 'فلترة حسب إسم أو رقم المساق',           'cols' => '4'],
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
