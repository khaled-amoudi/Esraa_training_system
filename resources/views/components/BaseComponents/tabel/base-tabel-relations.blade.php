@props([
    'tabel_data' => [],
    'ths' => [],
    'model',
    'models',
    'fillable_images' => [],
    'fillables' => [],
    'fillable_badges' => [],
    'fillable_badge_values' => [],
    'fillable_badges_array',
    'fillables_relation_many',
    'fillables_relation_many_groups',
    'actions' => [],
    'export_excel',
    'export_excel_demo',
    'export_pdf',
    'import_excel',
    'text_filters',
    'select_fixed_filters',
])

<div class="card mb-2">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0">{{ ucwords($tabel_data['table_title']) }}</h5>
            <div>
                {{ $slot }}
            </div>
        </div>
        <hr style="color: rgb(173, 173, 173)">
        <div class="filters">
            <div class="ms-auto position-relative">
                <form action="{{ URL::current() }}" method="get">
                    <div class="row">
                        @include('components.BaseComponents.tabel.tabel_partials.filters')
                    </div>
                    {{-- Hidden Submit Button --}}
                    <button class="btn btn-sm btn-dark d-none" type="submit">فلترة</button>
                </form>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        @isset($ths)
                            @foreach ($ths as $th)
                                <th>{{ $th }}</th>
                            @endforeach
                        @endisset
                    </tr>
                </thead>

                <tbody>
                    @forelse ($models as $data)
                        <tr class="bg-accent-on-hover {{ $loop->odd ? 'bg-accent' : '' }}">

                            <td>{{ $data['id'] }}</td>

                            @isset($fillables)
                                @foreach ($fillables as $fillable)
                                    <td class="td-max-words">{{ $data[$fillable] }}</td>
                                @endforeach
                            @endisset

                            {{-- BADGES or TAGS --}}
                            @isset($fillable_badges)
                                @foreach ($fillable_badges as $badge_attr => $badge_data)
                                    <td>
                                        @foreach ($badge_data as $key => $value)
                                            @if ($data[$badge_attr] == $key)
                                                <span class="badge py-1 px-2 rounded-pill {{ $value[1] }}"
                                                    style="font-size: 12px; font-weight: 500;">
                                                    {{ $value[0] }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            @endisset

                            {{-- show array like ['Ali', 'Khaled', 'Ahmed'] as badges --}}
                            @isset($fillable_badges_array)
                                @foreach ($fillable_badges_array as $fillable_array)
                                    <td>
                                        @foreach ($data[$fillable_array] as $badge)
                                            <span class="badge py-1 px-2 alert-primary"
                                                style="font-size: 12px; font-weight: 500;">{{ $badge }}</span>
                                        @endforeach
                                    </td>
                                @endforeach
                            @endisset

                            {{-- show one to many or many to many relations as badges --}}
                            @isset($fillables_relation_many)
                                @foreach ($fillables_relation_many as $fillables)
                                    <td>
                                        @foreach ($data[$fillables] as $badge)
                                            <span class="badge bg-dark py-1 px-2 rounded-pill"
                                                style="font-size: 12px; font-weight: 500;">
                                                {{ $badge['name'] }}
                                            </span>
                                        @endforeach
                                    </td>
                                @endforeach
                            @endisset
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($ths) }}">
                                    <div class="text-secondary fw-bold pt-3 text-center">
                                        <img class="w-25 h-25" src="{{ asset('admin/assets/images/no-data-1.svg') }}"
                                            alt="">
                                            <div class="my-3 fw-normal">يبدو أنه لا يوجد أي بيانات لعرضها</div>
                                        {{-- <div class="mt-4">OOPS, There Is No {{ $tabel_data['table_title'] }} Yet 😴</div> --}}
                                    </div>
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
            {{-- </form> --}}
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    {{ isset($model) ? $model->withQueryString()->links() : '' }}
</div>

{{-- Docs
    Author: khaled - 16/09/2022
_____________________________________________________________________________________
    'tabel_data' => [],
    'ths' => [],
    'models' => [],
    'fillable_images' => [],
    'fillables' => [],
    'fillable_badges' => [],
    'fillable_badge_values' => [],
    'actions' => [],

    * tabel_data => array contain some of fixed data in the tabel ex: crete button text, tabel title, ..
    * ths => array contain the list of <th> `s of the tabel
    * models => array came from the controller which is the data from DB to be show it in the tabel
    * fillable_images => columns from DB that are images
    * fillables => columns from DB that are normal models [text]
    * fillable_badges => columns from DB that are badges .e.g.[is_active, status, ..]
    * fillable_badge_values => cases of badges to customize .e.g.[active=>green. in active=>red, ..]


    Full EXAMPLE:-

        <x-BaseComponents.tabel.base-tabel
        :tabel_data="[
            'table_title' => 'Categories',
            'table_button_text' => 'Create Category',
            'table_button_route' => 'dashboard.categories.create']"

        :ths="['#', 'Image', 'Name', 'Parent ID', 'Description', 'Status', 'Actions']"

        :models="$models"
        :fillable_images="['image']"
        :fillables="['name', 'parent_id', 'description']"
        :fillable_badges="['status']"
        :fillable_badge_values="['active', 'archive', '', '']"
        :actions="[
            'route_show' => 'dashboard.categories.show',
            'icon_class_show' => 'bi bi-eye-fill text-primary',

            'route_edit' => 'dashboard.categories.edit',
            'icon_class_edit' => 'bi bi-pencil-fill text-warning',

            'route_destroy' => 'dashboard.categories.destroy',
            'icon_class_destroy' => 'bi bi-trash-fill text-danger',
        ]"
        :export_excel="['route_name'=>'dashboard.categories.exportExcel']"
        :export_pdf="['route_name'=>'#']"
        :import_excel="['route_name'=>'#']"

        :textFilter="['route' => 'dashboard.categories.index', 'name' => 'search', 'label' => 'filter by name, description']"
    />
_____________________________________________________________________________________ --}}
