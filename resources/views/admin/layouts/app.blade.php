<!doctype html>
<html lang="tr" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tuğran Demirel">
    <link rel="icon" href="{{ asset('assets/admin/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('assets/admin/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('assets/admin/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/header-colors.css') }}" rel="stylesheet" />

    <title>@yield('title')</title>
</head>

<body>


<!--start wrapper-->
<div class="wrapper">
    <!--start top header-->
    @include('admin.layouts.header')
    <!--end top header-->

    <!--start sidebar -->
    @include('admin.layouts.navbar')
    <!--end sidebar -->

    <!--start content-->
    <main class="page-content">
        @yield('content')
    </main>
    <!--end page main-->

    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->

</div>
<!--end wrapper-->


<!-- Bootstrap bundle JS -->
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/easyPieChart/jquery.easypiechart.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/admin/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<!--app-->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script src="{{ asset('assets/admin/js/index.js') }}"></script>

</body>

</html>
