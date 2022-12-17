<!doctype html>
<html lang="ar" dir="rtl" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('admin/assets/images/main-logo.png') }}" style="width: 50px" type="image/png" />

    <!-- date time picker css links-->
    {{-- <link href="{{ asset('admin/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/datetimepicker/css/classic.time.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet"> --}}

    <!--plugins-->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/notifications/css/lobibox.min.css') }}">
    <link href="{{ asset('admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <!-- loader-->
    <link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('admin/assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/header-colors.css') }}" rel="stylesheet" />

    @stack('style')

    <title>Al Esraa Training System</title>
    {{-- <title>{{ __('messages.app_name') }}</title> --}}

    <style>
        body,
        * {

            /* font-family: 'Inter', sans-serif; */
            /**** font-family: 'Nunito', sans-serif; *****/
            /* font-family: 'Roboto', sans-serif; */


            /*** ARABIC ***/
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>

<body>




    <x-BaseComponents.alert.alert type="success" />
    <x-BaseComponents.alert.alert type="fail" />
    <x-BaseComponents.alert.alert_error_list /> {{-- This Occur For Import Excel Errors --}}

    <!--start wrapper-->
    <div class="wrapper">

        @if (request()->routeIs(['dashboard', 'dashboard.*']))
            @include('layouts.partials.header_dashboard')
        @elseif (request()->routeIs(['teacher', 'teacher.*']))
            @include('layouts.partials.header_teacher')
        @endif

        <x-BaseComponents.layout.sidebar />

        <main class="page-content">
            @yield('master')
        </main>

        @include('layouts.partials.overlay')
        @include('layouts.partials.back-to-top')
        {{-- @include('layouts.partials.switcher') --}}


    </div>
    <!--end wrapper-->









    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- date time picker scripts-->
    {{-- <script src="{{ asset('admin/assets/plugins/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datetimepicker/js/picker.date.js') }}"></script> --}}

    <!--plugins-->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>

    <!--app-->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/js/index.js') }}"></script>

    @stack('script')

    <script>
        new PerfectScrollbar(".best-product")
    </script>
</body>

</html>
