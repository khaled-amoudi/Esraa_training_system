@extends('Layouts.master')

@section('master')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('dashboard.year.update', $model->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('dashboard.year._form_year', [
                        'form_title' => 'تعديل السنة الدراسية',
                    ])


                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
