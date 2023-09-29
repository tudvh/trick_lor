<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" data-index="{{ URL::to('/'); }}">
    <title>@yield('title') - Trick loR Admin</title>
    <link rel="icon" href="{{ url('public/assets/img/logo-icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/header.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('public/admin/css/content.css') }}">
    @yield('css')
</head>

<body>
    <div class="wrapper">
        @include('layouts/admin/layoutItems/header')

        @include('layouts/admin/layoutItems/sidebar')

        <div class="content">
            <h1 class="title">@yield('title-content')</h1>
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>

        <div class="overlay"></div>

        <div class="loading-overlay none">
            <div class="loading-icon">
                <i class="fa-solid fa-spinner"></i>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('public/admin/js/admin.js') }}"></script>
    <script src="{{ url('public/assets/js/sidebar-mobile.js') }}"></script>
    <!-- <script src="{{ url('public/assets/js/hide-logo.js') }}"></script> -->
    @yield('js')
</body>


</html>