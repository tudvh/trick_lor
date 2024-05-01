<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" data-index="{{ URL::to('/') }}">
    <meta property="og:image" content="{{ url('assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
    @yield('meta')
    <title>@yield('title') - Trick loR Admin</title>
    <link rel="icon" href="{{ url('assets/img/logo-icon.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <!-- Local -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('adm/css/admin.css') }}">
    <link rel="stylesheet" href="{{ url('adm/css/header.css') }}">
    <link rel="stylesheet" href="{{ url('adm/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('adm/css/main.css') }}">
    @yield('css')
    <!-- Sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        @include('partials/admin/header')

        @include('partials/admin/sidebar')

        <div class="main">
            <div class="content">
                @yield('content')
            </div>
        </div>

        <div class="overlay"></div>

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
    <script src="{{ url('assets/js/assets.js') }}"></script>
    <script src="{{ url('assets/js/sidebar-mobile.js') }}"></script>
    <!-- <script src="{{ url('assets/js/hide-logo.js') }}"></script> -->
    @yield('js')
</body>

</html>
