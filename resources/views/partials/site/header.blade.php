<header>
    <div class="container">
        <div class="logo">
            <button class="sidebar-menu header-icon-btn">
                <i class="fa-sharp fa-regular fa-bars"></i>
            </button>
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
                        <a href="{{ route('site.profile', ['username' => $user->username]) }}" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                            <span class="w-100">Trang cá nhân</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.my-posts.index') }}" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-blog"></i>
                            </div>
                            <span class="w-100">Bài đăng của tôi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.activities.view') }}" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-sharp fa-solid fa-clock-rotate-left"></i>
                            </div>
                            <span class="w-100">Nhật ký hoạt động</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.auth.personal') }}" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <span class="w-100">Tài khoản</span>
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
            <button type="button" class="btn login-btn" data-bs-toggle="modal" data-bs-target="#auth-overlay">Đăng nhập</button>
            @endauth
        </div>
    </div>
</header>

@guest('site')
<div class="modal fade" id="auth-overlay" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <livewire:site.auth.auth />
    </div>
</div>
@endguest