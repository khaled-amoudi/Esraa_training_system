@extends('Layouts.master')

@section('master')

    @if (isset($groups))
        <div class="position-relative">
            <h6 class="mb-4 teacher_groups">مجموعاتي</h6>
        </div>
        <div class="row">
            @forelse ($groups as $group)
                <div class="col-3">
                    <a class="text-secondary" href="{{ route('teacher.teacher_group.show', $group->id) }}">
                        <div class="card"
                             style="background-color: #d3e8ff; background-image: linear-gradient(62deg, #d3e8ff 0%, #f3e9ff 100%);">
                            <div class="card-body text-center">
                                <div class="fw-bold">
                                    {{ $group->name }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="text-secondary fw-bold pt-3 text-center">
                    <img class="w-25" src="{{ asset('admin/assets/images/no-data-3.svg') }}"
                         alt="">
                    <div class="mt-4 fw-normal">لا يوجد أي مجموعات خاصة بك لعرضها</div>
                </div>
            @endforelse
        </div>
    @endif

    <hr style="color: rgb(173, 173, 173)">

@endsection
