@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'المجموعات المؤرشفة',
            'table_button_route' => 'dashboard.group.create'
        ]"

        :ths="['#', 'إسم المجموعة', 'رقم المجموعة', 'المساق', 'المدرب', 'تاريخ الأرشفة', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['name', 'group_number', 'course_id', 'teacher_id', 'deleted_at']"

        :actions="[
            'route_restore' => 'dashboard.group.restore',
            'icon_class_restore' => 'bx bx-history font-20',

            'route_force_delete' => 'dashboard.group.forceDelete',
            'icon_class_force_delete' => 'bi bi-trash-fill text-danger',
        ]"

        :text_filters="[
            ['name' => 'name_groupNumber',           'label' => 'فلترة حسب إسم أو رقم المجموعة',         'cols' => '4'],
        ]"

    />
@endsection
