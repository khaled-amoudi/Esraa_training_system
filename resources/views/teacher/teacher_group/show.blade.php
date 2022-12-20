@extends('Layouts.master')

@push('style')
    <style>
        .kh-modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 999;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .kh-modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        /* The Close Button */
        .kh-close {
            color: #3a3e41;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .kh-close:hover,
        .kh-close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .kh-modal-header {
            padding: 2px 16px;
            background-color: #ececec;
            color: white;
        }

        .kh-modal-body {
            padding: 2px 16px;
        }

        .kh-modal-footer {
            padding: 2px 16px;
            background-color: #ececec;
            color: white;
        }
    </style>
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('master')
    <div class="card mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>مجموعة/ {{ $model['name'] }}</h5>
            <div class="d-flex justify-content-end m-0">
                <div class="group_students_attendance me-2">
                    <button id="student_attendances" data-route="{{ route('teacher.student_attendances', $model['id']) }}"
                        class="btn btn-sm bg-gradient-amour text-white border-0 py-2">
                        كشف دوام الطلاب
                    </button>
                </div>
                <div class="group_students_attendance">
                    <button id="student_grades" data-route="{{ route('teacher.student_grades', $model['id']) }}"
                        class="btn btn-sm bg-gradient-amour text-white border-0 py-2">
                        درجات الطلاب
                    </button>
                </div>

                <div class="assign_student_to_group ms-2">
                    <button type="button" class="btn btn-sm bg-purple border-0 py-2 text-white" id="kh-myBtn">إضافة طالب
                        للمجموعة +</button>
                    <!-- Modal -->
                    <div class="kh-modal" id="kh-myModal">
                        <div class="kh-modal-content rounded-3">
                            <form class="rounded-3" action="{{ route('teacher.attach_student_to_group') }}" method="post">
                                @csrf

                                <div class="kh-modal-header rounded-3 text-dark d-flex align-items-center justify-content-between px-4 py-2">
                                    <h5>إضافة طالب جديد لهذه
                                        المجموعة
                                    </h5>
                                    <span class="kh-close mb-2">&times;</span>
                                </div>
                                <div class="kh-modal-body p-4">
                                    <div class="mb-3">
                                        <label class="form-label">إختر طالب لإضافته للمجموعة</label>
                                        <select class="single-select" name="student_id">
                                            @foreach ($additionalData['all_students'] as $student)
                                                <option value="{{ $student['id'] }}">
                                                    {{ $student['university_number'] . ' - ' . $student['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="group_id" value="{{ $model['id'] }}">
                                    <input type="hidden" name="semester_id" value="{{ $current_semester?->id }}">

                                </div>
                                <div class="kh-modal-footer rounded-3 px-4 py-3 d-flex justify-content-end">
                                    <button type="submit" class="btn bg-purple text-white">تأكيد إضافة الطالب</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row p-0 m-0">
                @php
                    $lists = [['label' => 'إسم المجموعة', 'attribute' => 'name'], ['label' => 'رقم المجموعة', 'attribute' => 'group_number'], ['label' => 'المساق', 'attribute' => 'course_id'], ['label' => 'عدد طلاب المجموعة', 'attribute' => 'group_students_number']];
                @endphp
                @foreach ($lists as $list)
                    <div class="col-12 col-md-6 border p-2 d-flex align-items-center">
                        <div class="row w-100 ">
                            <div class="col-4 d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ $list['label'] }}</span>
                                <span>:</span>
                            </div>
                            <div class="col-8 d-flex justify-content-between align-items-center p-0">
                                <span>{{ $model[$list['attribute']] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div id="group-details">
        @include('teacher.teacher_group.render.render_student_attendance')
    </div>
@endsection


@push('script')
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/form-select2.js') }}"></script>


    <script>
        // Get the modal
        var modal = document.getElementById("kh-myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("kh-myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("kh-close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        (function($) {

            "use strict";

            $('#student_grades').on('click', function() {
                var route = $(this).data('route');
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        "action-button": 'student_grades'
                    },
                    datatype: "json",
                    success: function(response) {
                        console.log('student_grades', response);
                        $("#group-details").html(response.html);
                    },
                    error: function(error) {},
                });
            });


            $('#student_attendances').on('click', function() {
                var route = $(this).data('route');
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        "action-button": 'student_attendances'
                    },
                    datatype: "json",
                    success: function(response) {
                        console.log('student_attendances', response);
                        $("#group-details").html(response.html);
                    },
                    error: function(error) {},
                });
            });
        })(jQuery)
    </script>
@endpush
