@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'المجموعات',
            'table_button_route' => 'dashboard.group.create']"

        :ths="['#', 'إسم المجموعة', 'رقم المجموعة', 'المساق', 'المدرب', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['name', 'group_number', 'course_id', 'teacher_id']"


        :actions="[
            // 'show_modal' => true,
            'route_show' => 'dashboard.group.show',
            'icon_class_show' => 'bi bi-eye-fill text-primary',

            'route_edit' => 'dashboard.group.edit',
            'icon_class_edit' => 'bi bi-pencil-fill text-warning',

            'route_destroy' => 'dashboard.group.destroy',
            'icon_class_destroy' => 'bi bi-trash-fill text-danger',
            'with_soft_delete' => true,
        ]"

        :export_excel="['route_name'=>'dashboard.group.exportExcel']"
        :export_excel_demo="['route_name'=>'dashboard.group.exportExcelDemo']"
        :export_pdf="['route_name'=>'dashboard.group.exportPdf']"
        :import_excel="['route_name'=>'dashboard.group.importExcel']"

        :text_filters="[
            ['name' => 'name_groupNumber',           'label' => 'فلترة حسب إسم أو رقم المجموعة',         'cols' => '4'],
        ]"
    />
@endsection
