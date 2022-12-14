@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.group.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('dashboard.group._form_group', [
                        'form_title' => 'إنشاء مجموعة',
                    ])

                </form>
            </div>
        </div>
    </div>

@endsection
