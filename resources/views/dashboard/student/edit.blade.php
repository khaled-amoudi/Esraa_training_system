@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.student.update', $model->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('dashboard.student._form_student', [
                        'form_title' => 'تعديل الطالب'
                    ])

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
