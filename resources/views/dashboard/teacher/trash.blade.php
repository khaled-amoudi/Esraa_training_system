@extends('Layouts.master')

@section('master')
    <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'المدربين المؤرشفين',
            'table_button_route' => 'dashboard.teacher.create'
        ]"

        :ths="['#', 'إسم المدرب', 'رقم الهوية الشخصية', 'تاريخ الأرشفة', 'الإجراءات']"

        :model="$model"
        :models="$models"
        :fillables="['name', 'personalId', 'deleted_at']"

        :actions="[
            'route_restore' => 'dashboard.teacher.restore',
            'icon_class_restore' => 'bx bx-history font-20',

            'route_force_delete' => 'dashboard.teacher.forceDelete',
            'icon_class_force_delete' => 'bi bi-trash-fill text-danger',

            // 'with_delete_group' => true,
        ]"

        :text_filters="[
            ['name' => 'name_personalId',            'label' => 'فلترة حسب الإسم أو رقم الهوية',          'cols' => '4'],
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
