<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Trick loR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/site/css/site.css') }}">
    @yield('css')
</head>

<body>
    @include('layouts/site/layoutItems/header')

    <div class="main">
        <div class="container d-flex gap-3">
            @include('layouts/site/layoutItems/sidebar')

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setHeightMainBox() {
            const headerElement = document.querySelector('header')
            const headerHeight = headerElement.offsetHeight

            const mainBox = document.querySelector('.main')
            mainBox.style.paddingTop = (headerHeight + 30) + 'px'
        }

        setHeightMainBox()
        window.addEventListener('resize', setHeightMainBox)
    </script>
    @yield('js')
</body>

</html>