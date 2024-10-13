<!DOCTYPE html>
<html dir="ltr" lang="zxx">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! SEO::generate() !!}
    @if ($config)
        <link rel="shortcut icon" href="{{ asset('files/config/' . $config->fav) }}" type="image/x-icon">
    @endif
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allura&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('themes/default') }}/css/plugins/swiper.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('themes/default') }}/css/style.css" type="text/css">
    @yield('style')
</head>

<body>
    @include('themes.default.layout.header')
    <main>
        @yield('content')
    </main>

    @include('themes.default.layout.footer')
    @include('themes.default.layout.modal')
    <!-- Page Overlay -->
    <div class="page-overlay"></div><!-- /.page-overlay -->
    <script src="{{ asset('themes/default') }}/js/plugins/jquery.min.js"></script>
    <script src="{{ asset('themes/default') }}/js/plugins/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('themes/default') }}/js/plugins/bootstrap-slider.min.js"></script>
    <script src="{{ asset('themes/default') }}/js/plugins/swiper.min.js"></script>
    <script src="{{ asset('themes/default') }}/js/plugins/countdown.js"></script>
    <script src="{{ asset('themes/default') }}/js/theme.js"></script>
</body>

</html>
