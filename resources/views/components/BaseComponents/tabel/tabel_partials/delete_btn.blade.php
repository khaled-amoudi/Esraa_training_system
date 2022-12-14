
<a href="#" type="button" class="btn btn-sm p-0 m-0" data-bs-toggle="modal"
    data-bs-target="#exampleModalAction{{ $data['id'] }}"
    data-bs-original-title="Trash" aria-label="Trash">
    <i class="{{ $actions['icon_class_destroy'] }}"></i>
</a>
<div class="modal fade" id="exampleModalAction{{ $data['id'] }}" tabindex="-1"
    aria-labelledby="exampleModalActionLabel{{ $data['id'] }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <div class="modal-header px-3 py-1">
                <h5 class="modal-title" id="exampleModalActionLabel{{ $data['id'] }}">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body text-center text-secondary py-4 fw-bold">
                {{ isset($actions['with_soft_delete']) && $actions['with_soft_delete'] == true ? 'نقل هذا العنصر إلى الأرشيف ؟' : 'هل أنت متأكد من حذف هذا العنصر ؟' }}

            </div>
            <div class="modal-footerXXX d-flex justify-content-center pb-4">
                <form action="{{ route($actions['route_destroy'], $data['id']) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-cancel shadow-sm" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger-custom shadow-sm mx-2">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
