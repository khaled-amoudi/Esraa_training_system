@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel :tabel_data="[
        'table_title' => 'مجموعاتي',
    ]" :ths="['#', 'إسم المجموعة', 'رقم المجموعة', 'المساق', 'الإجراءات']" :model="$model" :models="$models"

    :fillables="['name', 'group_number', 'course_id']"

        :actions="[
            'route_show' => 'teacher.teacher_group.show',
            'icon_class_show' => 'bi bi-eye-fill text-primary',
        ]"

        :text_filters="[
            ['name' => 'name_groupNumber',           'label' => 'فلترة حسب إسم أو رقم المجموعة',         'cols' => '4'],
        ]"
        />
@endsection
