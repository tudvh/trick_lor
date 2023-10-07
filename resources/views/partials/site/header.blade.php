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
                    <input type="text" name="q" autocomplete="off" placeholder="Tìm kiếm..." value="@if (isset($searchKey)){{ $searchKey }}@endif">
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
            @auth('site')
            <div class="btn-group">
                <button type="button" class="user-avatar dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    @php
                    $user = auth()->guard('site')->user()
                    @endphp

                    @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->full_name }}">
                    @else
                    <img src="{{ url('public/assets/img/logo-icon.png') }}" alt="{{ $user->full_name }}">
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="#" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <span class="w-100">Tài khoản</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                            <div class="icon-box">
                                <i class="fa-solid fa-gear"></i>
                            </div>
                            <span class="w-100">Cài đặt</span>
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

<div class="modal fade" id="auth-overlay" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf

                <!-- Login -->
                <div id="login-container">
                    <div class="form-container d-flex flex-column gap-3">
                        <h1 class="title">Đăng nhập</h1>
                        <form id="login-form" class="form d-flex flex-column gap-4">
                            <div class="form-group">
                                <label for="login-email">Email</label>
                                <input type="email" name="login_email" id="login-email" placeholder="Nhập email..." required>
                            </div>
                            <div class="form-group">
                                <label for="login-password">Mật khẩu</label>
                                <input type="password" name="login_password" id="login-password" placeholder="Nhập mật khẩu..." required>
                                <div class="forgot ms-auto">
                                    <button rel="noopener noreferrer" type="button">Quên mật khẩu?</button>
                                </div>
                            </div>
                            <button type="submit" class="submit">ĐĂNG NHẬP</button>
                        </form>
                        <div class="social-message">
                            <div class="line"></div>
                            <p class="message">Đăng nhập bằng tài khoản khác</p>
                            <div class="line"></div>
                        </div>
                        <div class="social-icons">
                            <button type="button" class="icon btn auth-google">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 48 48" version="1.1">
                                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Color-" transform="translate(-401.000000, -860.000000)">
                                            <g id="Google" transform="translate(401.000000, 860.000000)">
                                                <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"></path>
                                                <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"></path>
                                                <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"></path>
                                                <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <p class="signup">Chưa có tài khoản?
                            <button type="button" id="switch-to-register"> ĐĂNG KÝ</button>
                        </p>
                    </div>
                </div>

                <!-- Register -->
                <div id="register-container" class="d-none">
                    <div class="form-container d-flex flex-column gap-3">
                        <h1 class="title">Đăng ký</h1>
                        <form id="register-form" class="form d-flex flex-column gap-4">
                            <div class="form-group">
                                <label for="register-full-name">Họ và tên</label>
                                <input type="text" name="register_full_name" id="register-full-name" placeholder="Nhập họ và tên..." required>
                            </div>
                            <div class="form-group">
                                <label for="register-email">Email</label>
                                <input type="email" name="register_email" id="register-email" placeholder="Nhập email..." required>
                            </div>
                            <div class="form-group">
                                <label for="register-password">Mật khẩu</label>
                                <input type="password" name="register_password" id="register-password" placeholder="Nhập mật khẩu..." pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$" title="Mật khẩu phải chứa ít nhất một chữ cái thường, một chữ cái in hoa và một số" required>
                            </div>
                            <div class="form-group">
                                <label for="register-password-confirm">Mật khẩu xác nhận</label>
                                <input type="password" name="register_password_confirm" id="register-password-confirm" placeholder="Nhập mật khẩu xác nhận..." required>
                            </div>
                            <button type="submit" class="submit">ĐĂNG KÝ</button>
                        </form>
                        <div class="social-message">
                            <div class="line"></div>
                            <p class="message">Đăng ký bằng tài khoản khác</p>
                            <div class="line"></div>
                        </div>
                        <div class="social-icons">
                            <button type="button" class="icon btn auth-google">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 48 48" version="1.1">
                                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Color-" transform="translate(-401.000000, -860.000000)">
                                            <g id="Google" transform="translate(401.000000, 860.000000)">
                                                <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"></path>
                                                <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"></path>
                                                <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"></path>
                                                <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <p class="signup">Đã có tài khoản?
                            <button type="button" id="switch-to-login"> ĐĂNG NHẬP</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>