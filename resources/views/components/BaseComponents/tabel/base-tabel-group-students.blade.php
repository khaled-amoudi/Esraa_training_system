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
        </div>
        <hr style="color: rgb(173, 173, 173)">
        <div class="filters my-4">
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

                            {{-- NORMAL DATA WITHOUT ADDITIONALS --}}
                            @isset($fillables)
                                @foreach ($fillables as $fillable)
                                    <td class="td-max-words">{{ $data[$fillable] }}</td>
                                    {{-- overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 150px; --}}
                                @endforeach
                            @endisset

                            {{-- ACTIONS --}}
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">

                                    @if (isset($actions['route_destroy']))
                                        <a href="#" type="button" class="btn btn-sm p-0 m-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModalAction{{ $data['id'] }}"
                                            data-bs-original-title="Trash" aria-label="Trash">
                                            <i class="{{ $actions['icon_class_destroy'] }}"></i>
                                        </a>
                                        <div class="modal fade" id="exampleModalAction{{ $data['id'] }}"
                                            tabindex="-1" aria-labelledby="exampleModalActionLabel{{ $data['id'] }}"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    {{-- <div class="modal-header px-3 py-1">
            <h5 class="modal-title" id="exampleModalActionLabel{{ $data['id'] }}">Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> --}}
                                                    <div class="modal-body text-center text-secondary py-4 fw-bold">
                                                        هل أنت متأكد من إزالة هذا الطالب من المجموعة ؟
                                                    </div>
                                                    <div class="modal-footerXXX d-flex justify-content-center pb-4">
                                                        <form
                                                            action="{{ route($actions['route_destroy'], [$actions['first_param'] ?? $data['id'], isset($actions['second_param']) ?? '']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-cancel shadow-sm"
                                                                data-bs-dismiss="modal">إلغاء</button>
                                                            <button type="submit"
                                                                class="btn btn-danger-custom shadow-sm mx-2">حذف</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($ths) }}">
                                <div class="text-secondary fw-bold pt-3 text-center">
                                    <img class="w-25 h-25" src="{{ asset('admin/assets/images/no-data-3.svg') }}"
                                        alt="">
                                        <div class="my-3 fw-normal">يبدو أنه لا يوجد أي بيانات لعرضها</div>
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
