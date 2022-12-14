@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.course.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('dashboard.course._form_course', [
                        'form_title' => 'إضافة مساق',
                    ])

                </form>
            </div>
        </div>
    </div>

@endsection
