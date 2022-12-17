@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col">
            <div class="card radius-10">
                <a class="text-dark" href="{{ route('dashboard.course.index') }}">
                    <div class="card-body text-center">
                        <div class="widget-icon mx-auto mb-3 bg-light-success text-success">
                            <i class="lni lni-book"></i>
                        </div>
                        <h3>{{ $courses_count }}</h3>
                        <p class="mb-0">المساقات</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <a class="text-dark" href="{{ route('dashboard.group.index') }}">
                    <div class="card-body text-center">
                        <div class="widget-icon mx-auto mb-3 bg-light-danger text-danger">
                            <i class="lni lni-vector"></i>
                        </div>
                        <h3>{{ $groups_count }}</h3>
                        <p class="mb-0">المجموعات</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <a class="text-dark" href="{{ route('dashboard.teacher.index') }}">
                    <div class="card-body text-center">
                        <div class="widget-icon mx-auto mb-3 bg-light-purple text-purple">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <h3>{{ $teachers_count }}</h3>
                        <p class="mb-0">المدربين</p>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="row mt-2">
        <div class="col">
            <div class="card radius-10 border-0 border-start border-pink border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h6 class="mb-1">الفصل الدراسي الحالي</h6>
                            <h4 class="mb-0 text-pink">{{ $current_semester->name }}</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-pink text-white">
                            <i class="lni lni-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-5">
        <x-BaseComponents.tabel.base-tabel :tabel_data="[
            'table_title' => 'المدربين',
            'table_button_route' => 'dashboard.teacher.create',
        ]" :ths="['#', 'إسم المدرب', 'رقم الهوية الشخصية', 'الإجراءات']" :model="$teacher" :models="$teachers"
            :fillables="['name', 'personalId']" :actions="[
                // 'show_modal' => true,
                'route_show' => 'dashboard.teacher.show',
                'icon_class_show' => 'bi bi-eye-fill text-primary',

                'route_edit' => 'dashboard.teacher.edit',
                'icon_class_edit' => 'bi bi-pencil-fill text-warning',

                'route_destroy' => 'dashboard.teacher.destroy',
                'icon_class_destroy' => 'bi bi-trash-fill text-danger',
                'with_soft_delete' => true,
            ]" :export_excel="['route_name' => 'dashboard.teacher.exportExcel']" :export_excel_demo="['route_name' => 'dashboard.teacher.exportExcelDemo']" :export_pdf="['route_name' => 'dashboard.teacher.exportPdf']" :import_excel="['route_name' => 'dashboard.teacher.importExcel']"
            :text_filters="[['name' => 'name_personalId', 'label' => 'فلترة حسب الإسم أو رقم الهوية', 'cols' => '4']]" />
    </div>
@endsection
