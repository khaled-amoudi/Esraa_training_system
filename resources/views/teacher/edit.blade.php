@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('teacher.update', $model->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('teacher._form_teacher', [
                        'form_title' => 'تغيير كلمة المرور'
                    ])

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
