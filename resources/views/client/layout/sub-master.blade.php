<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/client/assets/images/favicon.ico') }}">

    <!-- Google Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('theme/client/assets/css/vendor/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/client/assets/css/style.min.css') }}">

</head>

<body>

    <div class="main-wrapper main-wrapper-02">
        @include('client.layout.sub-header')

        <div class="section overflow-hidden position-relative" id="wrapper">
            <div class="page-content-wrapper py-0" style="overflow: auto">
                @yield('content')
            </div>
        </div>

        @include('client.layout.footer')

    </div>

    @yield('toast')

    <!-- Modernizer & jQuery JS -->
    <script src="{{ asset('theme/client/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('theme/client/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>

    <script src="{{ asset('theme/client/assets/js/plugins.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('theme/client/assets/js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>
