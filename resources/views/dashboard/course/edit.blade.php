@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.course.update', $model->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('dashboard.course._form_course', [
                        'form_title' => 'تعديل المساق'
                    ])

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
