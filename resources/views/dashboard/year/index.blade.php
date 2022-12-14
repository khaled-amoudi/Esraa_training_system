@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'السنوات الدراسية',
            'table_button_route' => 'dashboard.year.create']"

        :ths="['#', 'السنة', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['year']"
        :fillable_badges_relation="['semesters']"
        :actions="[
            'route_show' => 'dashboard.year.show',
            'icon_class_show' => 'bi bi-eye-fill text-primary',

            'route_edit' => 'dashboard.year.edit',
            'icon_class_edit' => 'bi bi-pencil-fill text-warning',
        ]"

        :text_filters="[
            ['name' => 'name',           'label' => 'فلترة حسب السنة الدراسية',         'cols' => '4'],
        ]"
    />
@endsection
