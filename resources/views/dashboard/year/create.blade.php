@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.year.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('dashboard.year._form_year', [
                        'form_title' => 'إضافة سنة دراسية',
                    ])

                </form>
            </div>
        </div>
    </div>

@endsection
