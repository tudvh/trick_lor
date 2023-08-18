<link rel="stylesheet" href="{{url('public/site/css/header.css')}}">


<header>
    <div class="d-flex flex-column flex-sm-row py-3 py-sm-0 gap-3 gap-sm-0 container">
        <div class="logo">
            <a href="{{ route('site.home') }}">
                <h2 class="fw-bold m-0">Trick loR</h2>
            </a>
        </div>

        <form class="search">
            <input type="text" name="search" autocomplete="off">
            <button class="submit-btn" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg>
            </button>
        </form>

        <div class="more d-flex gap-2">
            <a href="{{ route('site.home') }}" class="btn">Đăng nhập</a>
            <a href="{{ route('site.home') }}" class="btn btn-success">Đăng ký</a>
        </div>
    </div>
</header>