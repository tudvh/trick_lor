<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" data-index="{{ URL::to('/') }}">
    <meta property="og:type" content="article">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('public/assets/img/logo-icon.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">
    <!-- Local -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/site.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/header.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/content.css') }}">
    @guest('site')
    <link rel="stylesheet" href="{{ url('public/site/css/auth.css') }}">
    @endguest
    @yield('css')
    <!-- Sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <i class="fa-light fa-loader"></i>
            </div>
        </div>

        @if (session('error-notification'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Lỗi...",
                text: "{{ session('error-notification') }}",
            });
        </script>
        @endif
        @if (session('success-notification'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thành công",
                text: "{{ session('success-notification') }}",
            });
        </script>
        @endif
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Local -->
    <script src="{{ url('public/assets/js/assets.js') }}"></script>
    <script src="{{ url('public/site/js/header-open-search.js') }}"></script>
    <script src="{{ url('public/assets/js/sidebar-mobile.js') }}"></script>
    @guest('site')
    <script src="{{ url('public/site/js/auth.js') }}"></script>
    @endguest
    <!-- <script src="{{ url('public/assets/js/hide-logo.js') }}"></script> -->
    @yield('js')
</body>

</html>