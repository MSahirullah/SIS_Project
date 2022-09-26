<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <title>
        @yield('title') | SIS
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <style>
        .bg-gradient-primary {
            background-color: #3f51b5 !important;
            background-image: unset !important;
        }
        .active i {
            color:white!important;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">

    @include('include.sideNavigation')

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        @include('include.topNavigation')
        @yield('body')
    </main>

    @include('include.scripts')

</body>

</html>