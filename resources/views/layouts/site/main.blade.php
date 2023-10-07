<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" data-index="{{ URL::to('/'); }}">
    <title>@yield('title') - Trick loR</title>
    <link rel="icon" href="{{ url('public/assets/img/logo-icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/toast-custom.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/site.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/header.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/content.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/auth.css') }}">
    @yield('css')
</head>

<body>
    <div class="wrapper">
        @include('partials/site/header')

        <div class="main">
            <div class="container">
                <div class="d-flex w-100">
                    @include('partials/site/sidebar')

                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay"></div>

        <div class="loading-overlay d-none">
            <div class="loading-icon">
                <i class="fa-solid fa-spinner"></i>
            </div>
        </div>

        <div id="toast">
            @if (session('error-notification'))
            <div class="toast--custom toast--error" style="animation: slideInLeft ease .3s, fadeOut linear 1s 5s forwards">
                <div class="toast__icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="toast__body">
                    <h3 class="toast__title">Lỗi</h3>
                    <p class="toast__msg">{{ session('error-notification') }}</p>
                </div>
                <div class="toast__close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ url('public/assets/js/assets.js') }}"></script>
    <script src="{{ url('public/assets/js/toast-custom.js') }}"></script>
    <script src="{{ url('public/site/js/header-open-search.js') }}"></script>
    <script src="{{ url('public/site/js/auth.js') }}"></script>
    <script src="{{ url('public/assets/js/sidebar-mobile.js') }}"></script>
    <!-- <script src="{{ url('public/assets/js/hide-logo.js') }}"></script> -->

    <!-- <div style="text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;">
        <a title="Hosted on free web hosting 000webhost.com. Host your own website for FREE." target="_blank" href="https://www.000webhost.com/?utm_source=000webhostapp&amp;utm_campaign=000_logo&amp;utm_medium=website&amp;utm_content=footer_img">
            <img src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png" alt="www.000webhost.com">
        </a>
    </div>-->
    @yield('js')
</body>

</html>