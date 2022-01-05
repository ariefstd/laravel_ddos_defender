<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        {{ config('app.name') }} | @yield('title')
    </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/faviconbz.png') }}" type="image/x-icon">
    <!-- my-dashboard -->
    <link rel="stylesheet" href="{{ asset('vendor/my-dashboard/css/dashboard.css') }}">
    <!-- fontawesome -->
    <script src="{{ asset('vendor/fontawesome-free/js/all.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- icon flag -->
    <link rel="stylesheet" href="{{ asset('vendor/flag-icon-css/css/flag-icon.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS -->
    <link href="{{ asset('css/slim.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/Ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/rickshaw/css/rickshaw.min.css') }}">



    @stack('css-internal')
    @stack('css-external')
</head>

<body>
    <!-- begin:navbar -->
    @include('layouts._dashboard.navbar')
    <!-- end:navbar -->
    <div class="sidebar">
        <!-- begin:sidebar -->
        @include('layouts._dashboard.sidebar')
        <!-- end:sidebar -->
    </div>


    <section class="home-section">
        @yield('content')
    </section>

    <!-- scripts -->

    <!-- jquery -->
    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/dropdown.js') }}"></script>
    <!-- bootstrap bundle -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- my-dashboard -->
    <script src="{{ asset('vendor/my-dashboard/js/dashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js" integrity="sha512-hAJgR+pK6+s492clbGlnrRnt2J1CJK6kZ82FZy08tm6XG2Xl/ex9oVZLE6Krz+W+Iv4Gsr8U2mGMdh0ckRH61Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @include('sweetalert::alert')
    @stack('javascript-external')
    @stack('javascript-internal')
</body>

</html>