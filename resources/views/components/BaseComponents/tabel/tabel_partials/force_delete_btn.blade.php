
<a href="#" type="button" class="btn btn-sm p-0 m-0" data-bs-toggle="modal"
    data-bs-target="#exampleModalAction{{ $data['id'] }}"
    data-bs-original-title="Delete" aria-label="Delete">
    <i class="{{ $actions['icon_class_force_delete'] }}"></i>
</a>
<div class="modal fade" id="exampleModalAction{{ $data['id'] }}" tabindex="-1"
    aria-labelledby="exampleModalActionLabel{{ $data['id'] }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center text-secondary py-4 fw-bold">هل أنت متأكد من حذف هذه البيانات بشكل نهائي ؟</div>
            <div class="modal-footerXXX d-flex justify-content-center pb-4">
                <form action="{{ route($actions['route_force_delete'], $data['id']) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-cancel shadow-sm" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger-custom shadow-sm mx-2">حذف بشكل نهائي</button>
                </form>
            </div>
        </div>
    </div>
</div>
