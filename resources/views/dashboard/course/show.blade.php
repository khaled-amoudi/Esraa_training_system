@extends('Layouts.master')

@section('master')

@foreach ($model['groups'] as $item)
    {{ $item->name }}
@endforeach

<x-BaseComponents.widgets.list_data :model="$model" title="عرض المساق" :buttons="[
    [
        'route' => 'dashboard.course.index',
        'label' => 'المساقات',
        'class' => 'bg-dark text-white'
    ],
]"

:lists="[
    [
        'label' => 'إسم المساق',
        'attribute' => 'name'
    ],
    [
        'label' => 'رقم المساق',
        'attribute' => 'course_number'
    ],
    // [
    //     'type' => 'link',
    //     'label' => 'Category',
    //     'attribute' => 'category_name',
    //     'route' => 'dashboard.categories.show'
    // ],
]"
/>
@endsection
