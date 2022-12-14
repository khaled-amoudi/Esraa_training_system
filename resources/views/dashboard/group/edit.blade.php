@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.group.update', $model->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('dashboard.group._form_group', [
                        'form_title' => 'تعديل المجموعة'
                    ])

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
