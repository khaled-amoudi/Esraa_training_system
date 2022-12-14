@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'المدربين',
            'table_button_route' => 'dashboard.teacher.create']"

        :ths="['#', 'إسم المدرب', 'رقم الهوية الشخصية', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['name', 'personalId']"

        :actions="[
            // 'show_modal' => true,
            'route_show' => 'dashboard.teacher.show',
            'icon_class_show' => 'bi bi-eye-fill text-primary',

            'route_edit' => 'dashboard.teacher.edit',
            'icon_class_edit' => 'bi bi-pencil-fill text-warning',

            'route_destroy' => 'dashboard.teacher.destroy',
            'icon_class_destroy' => 'bi bi-trash-fill text-danger',
            'with_soft_delete' => true,
        ]"

        :export_excel="['route_name'=>'dashboard.teacher.exportExcel']"
        :export_excel_demo="['route_name'=>'dashboard.teacher.exportExcelDemo']"
        :export_pdf="['route_name'=>'dashboard.teacher.exportPdf']"
        :import_excel="['route_name'=>'dashboard.teacher.importExcel']"

        :text_filters="[
            ['name' => 'name_personalId',           'label' => 'فلترة حسب الإسم أو رقم الهوية',         'cols' => '4'],
        ]"
    />
@endsection
