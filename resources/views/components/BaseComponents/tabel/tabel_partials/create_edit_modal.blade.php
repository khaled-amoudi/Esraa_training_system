@props([
    'btn_label' => 'modal label',
    'btn_class' => 'btn-dark',
    'modal_size',
    'unique_key' => '',
    'model',
    'title' => '',
])



<a href="#" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalAction{{ $unique_key }}"
    data-bs-original-title="Create" aria-label="Create" class="btn btn-sm btn-primary shadow px-3 ms-1 {{ $btn_class }}">
    <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    </span>
    Add New
</a>
<div class="modal fade" id="exampleModalAction{{ $unique_key }}" tabindex="-1"
    aria-labelledby="exampleModalActionLabel{{ $unique_key }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog {{ $modal_size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalActionLabel{{ $unique_key }}">{{ $title }}</h5>
                <button type="button" class="btn-close bg-danger text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">

                <div class="row p-3">

                    {{ $slot }}

                    <div>
                        <button type="submit" class="btn btn-primary shadow mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-check-square">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            <span class="mx-1">Save</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


{{--Docs
    Author: khaled - 15/11/2022
_____________________________________________________________________________________
    * unique_key => pass unique key when use modal more than one time in the page.
    * model => [نادر الإستخدام] the Model (table) of this item.
    * btn_label => button label label.
    * btn_class => classes for modal button.
    * title => Modal title in header.
    * modal_size => type of modal size {e.g. modal-lg, modal-xl, ..}.

    Full EXAMPLE:-
    <x-BaseComponents.form.common.modal :unique_key="$model->id" btn_label="button" btn_class="btn-info" modal_size="modal-fullscreen" />
_____________________________________________________________________________________
--}}
