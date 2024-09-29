<?php
use App\Models\Config;

$config = Config::first();
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/assets/imgs/theme/favicon.svg"> --}}
    <!-- Template CSS -->
    <link href="{{ asset('backend') }}/assets/css/main.css" rel="stylesheet" type="text/css" />
    @if ($config)
        <link rel="shortcut icon" href="{{ asset('files/config/' . $config->fav) }}" type="image/x-icon">
    @endif

    <script src="{{ asset('backend') }}/assets/js/vendors/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/vendors/bootstrap.bundle.min.js"></script>
    <!-- include summernote css/js -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    @yield('style')
    @livewireStyles
</head>

<body class="light">
    <div class="screen-overlay"></div>
    @include('backend.include.sidebar')
    <main class="main-wrap">
        @include('backend.include.header')
        @yield('content')
        {{-- <footer class="main-footer font-xs">
            <div class="row pb-30 pt-15">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> ©, SynexDigital - HTML Ecommerce Template .
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">
                        All rights reserved
                    </div>
                </div>
            </div>
        </footer> --}}
    </main>

    <script src="{{ asset('backend') }}/assets/js/vendors/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/vendors/perfect-scrollbar.js"></script>
    {{-- <script src="{{ asset('backend') }}/assets/js/vendors/jquery.fullscreen.min.js"></script> --}}
    <script src="{{ asset('backend') }}/assets/js/vendors/chart.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script> --}}

    <!-- Main Script -->
    <script src="{{ asset('backend') }}/assets/js/main.js" type="text/javascript"></script>
    <script src="{{ asset('backend') }}/assets/js/custom-chart.js" type="text/javascript"></script>
    @yield('script')
    @livewireScripts
</body>

</html>
