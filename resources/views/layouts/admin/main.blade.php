<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" data-index="{{ URL::to('/'); }}">
    <meta property="og:image" content="{{ url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
    @yield('meta')
    <title>@yield('title') - Trick loR Admin</title>
    <link rel="icon" href="{{ url('public/assets/img/logo-icon.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <!-- Local -->
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/header.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/main.css') }}">
    @yield('css')
    <!-- Sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        @include('partials/admin/header')

        @include('partials/admin/sidebar')

        <div class="main">
            <div class="main-header">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h1 class="main-header-title me-auto">@yield('title-content')</h1>
                    <div class="main-header-action ms-auto">
                        @yield('action')
                    </div>
                </div>
            </div>
            <div class="content">
                @yield('content')
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

    <!-- Local -->
    <script src="{{ url('public/assets/js/assets.js') }}"></script>
    <script src="{{ url('public/assets/js/sidebar-mobile.js') }}"></script>
    <!-- <script src="{{ url('public/assets/js/hide-logo.js') }}"></script> -->
    @yield('js')
</body>


</html>