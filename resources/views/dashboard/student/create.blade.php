@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.student.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('dashboard.student._form_student', [
                        'form_title' => 'إضافة طالب',
                    ])

                </form>
            </div>
        </div>
    </div>

@endsection
