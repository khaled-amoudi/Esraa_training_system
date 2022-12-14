@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.teacher.update', $model->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('dashboard.teacher._form_teacher', [
                        'form_title' => 'تعديل المدرب'
                    ])

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
