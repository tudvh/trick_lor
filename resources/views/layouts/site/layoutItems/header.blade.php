<header>
    <div class="container">
        <div class="logo">
            <div class="sidebar-menu header-icon-btn">
                <i class="fa-solid fa-bars"></i>
            </div>
            <a href="{{ route('site.home') }}">
                <img src="{{ url('public/site/img/logo-web.png') }}" alt="Trick loR">
            </a>
        </div>

        <div class="search-wrapper">
            <div class="search-container gap-3">
                <div class="close-search-btn header-icon-btn">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <form class="search" action="{{ route('site.search') }}">
                    <input type="text" name="q" autocomplete="off" placeholder="Tìm kiếm...">
                    <span class="span-split"></span>
                    <button class="submit-btn" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="more">
            <div class="open-search-btn header-icon-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <a href="{{ route('site.home') }}" class="btn login-btn">Đăng nhập</a>
        </div>
    </div>
</header>