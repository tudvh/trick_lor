<header>
    <div class="container">
        <div class="logo">
            <div class="sidebar-menu header-icon-btn">
                <i class="fa-regular fa-bars"></i>
            </div>
            <a href="{{ route('site.home') }}">
                <img src="{{ url('public/site/img/logo-web.png') }}" alt="Trick loR">
            </a>
        </div>

        <div class="search-wrapper">
            <div class="search-container gap-3">
                <div class="close-search-btn header-icon-btn">
                    <i class="fa-regular fa-xmark"></i>
                </div>
                <livewire:site.header-search :searchKey="isset($searchKey) ? $searchKey : ''" />
            </div>
        </div>

        <div class="more">
            <div class="open-search-btn header-icon-btn">
                <i class="fa-regular fa-magnifying-glass"></i>
            </div>
            @auth('site')
            <div class="btn-group">
                <button type="button" class="user-avatar dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    @php
                    $user = auth()->guard('site')->user()
                    @endphp

                    <img src="{{ $user->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ $user->full_name }}" title="Tài khoản">
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="{{ route('site.personal') }}" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <span class="w-100">Tài khoản</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.activities.view') }}" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-list-ul"></i>
                            </div>
                            <span class="w-100">Nhật ký hoạt động</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.auth.logout') }}" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </div>
                            <span class="w-100">Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
            @else
            <button type="button" id="open-auth-btn" class="btn login-btn">Đăng nhập</button>
            @endauth
        </div>
    </div>
</header>

@guest('site')
@include('partials.site.auth')
@endguest