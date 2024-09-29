<!DOCTYPE html>
<html class="no-js" lang="en">


<!-- Mirrored from wp.alithemes.com/html/evara/evara-frontend/page-404.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Jul 2023 14:38:32 GMT -->
<head>
    <meta charset="utf-8">
    <title>404</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/imgs/theme/favicon.svg') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/maind134.css') }}">
</head>

<body>
    <main class="main page-404">
        <div class="container">
            <div class="row align-items-center height-100vh text-center">
                <div class="col-lg-8 m-auto">
                    <p class="mb-50"><img src="{{ asset('frontend/imgs/theme/404.png') }}" alt="" class="hover-up"></p>
                    <h2 class="mb-30">Page Not Found</h2>
                    <p class="font-lg text-grey-700 mb-30">
                        The link you clicked may be broken or the page may have been removed.<br> visit the <a href="{{ route('index') }}"> <span> Homepage</span></a> or <a href="{{ route('contact') }}"><span>Contact us</span></a> about the problem
                    </p>
                    <form class="contact-form-style text-center" id="contact-form" action="#" method="post">
                        {{-- <div class="row">
                            <div class="col-lg-6 m-auto">
                                <div class="input-style mb-20 hover-up">
                                    <input name="name" placeholder="Search" type="text">
                                </div>
                            </div>
                        </div> --}}
                        <a class="btn btn-default submit-auto-width font-xs hover-up" href="{{ route('index') }}">Back To Home Page</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- Template  JS -->
    <script src="assets/js/maind134.js?v=3.4"></script>
</body>


<!-- Mirrored from wp.alithemes.com/html/evara/evara-frontend/page-404.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Jul 2023 14:38:33 GMT -->
</html>
