@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.teacher.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('dashboard.teacher._form_teacher', [
                        'form_title' => 'إضافة مدرب',
                    ])

                </form>
            </div>
        </div>
    </div>

@endsection
