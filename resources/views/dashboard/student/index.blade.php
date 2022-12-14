@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'الطلاب',
            'table_button_route' => 'dashboard.student.create']"

        :ths="['#', 'إسم الطالب', 'الرقم الجامعي', 'الدرجة العلمية', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['name', 'university_number']"
        :fillable_badges="[
            'college' => ['بكالوريس' => ['بكالوريس', 'alert-primary'], 'دبلوم' => ['دبلوم', 'alert-info']],
        ]"


        :actions="[
            'route_destroy' => 'dashboard.student.destroy',
            'icon_class_destroy' => 'bi bi-trash-fill text-danger',
        ]"

        :export_excel="['route_name'=>'dashboard.student.exportExcel']"
        :export_excel_demo="['route_name'=>'dashboard.student.exportExcelDemo']"
        :export_pdf="['route_name'=>'dashboard.student.exportPdf']"
        :import_excel="['route_name'=>'dashboard.student.importExcel']"

        :text_filters="[
            ['name' => 'name_university_number',           'label' => 'فلترة حسب الإسم أو الرقم الجامعي',         'cols' => '4'],
        ]"
        :select_fixed_filters="[
            [
                'name' => 'college',
                'label' => 'فلترة حسب الدرجة العلمية',
                'cols' => '4',
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
