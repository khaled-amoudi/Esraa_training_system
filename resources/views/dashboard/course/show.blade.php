@extends('Layouts.master')

@section('master')
    @foreach ($model['groups'] as $item)
        {{ $item->name }}
    @endforeach

    <x-BaseComponents.widgets.list_data :model="$model" title="عرض المساق" :buttons="[
        [
            'route' => 'dashboard.course.index',
            'label' => 'العودة للمساقات',
            'class' => 'btn-outline-dark',
        ],
    ]" :lists="[
        [
            'label' => 'إسم المساق',
            'attribute' => 'name',
        ],
        [
            'label' => 'رقم المساق',
            'attribute' => 'course_number',
        ],
        [
            'label' => 'الدرجة العلمية',
            'attribute' => 'degree',
        ],
    ]" />



<x-BaseComponents.widgets.list_data :model="$model" :cols="12" title="مجموعات المساق"
:lists="[
    [
        'type' => 'relation_many',
        'route' => 'dashboard.group.show',
        'label' => 'المجموعات',
        'attribute' => 'groups',
    ],
]" />

@endsection
