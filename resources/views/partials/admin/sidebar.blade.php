<aside>
    <a class="logo-header" href="{{ route('admin.dashboard') }}">
        <h2>Trick loR Admin</h2>
    </a>

    <ul class="d-flex flex-column mt-3 pt-0 gap-1">
        <li>
            <div class="mb-3 pb-3 user-panel">
                <a class="d-flex align-items-center gap-2 " href="{{ route('admin.personal') }}">
                    @if (auth()->guard('admin')->user()->avatar)
                    <img src="{{ auth()->guard('admin')->user()->avatar }}" alt="{{ auth()->guard('admin')->user()->full_name }}">
                    @else
                    <img src="{{ url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ auth()->guard('admin')->user()->full_name }}">
                    @endif
                    <span>{{ auth()->guard('admin')->user()->full_name }}</span>
                </a>
            </div>
        </li>

        <li>
            <a class="d-flex align-items-center gap-2 @if(isset($page) && $page=='dashboard') active @endif" href="{{ route('admin.dashboard') }}">
                @if(isset($page) && $page=='dashboard')
                <i class="fa-solid fa-grid-horizontal"></i>
                @else
                <i class="fa-light fa-grid-horizontal"></i>
                @endif
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2 @if(isset($page) && $page=='categories') active @endif" href="{{ route('admin.categories.index') }}">
                @if(isset($page) && $page=='categories')
                <i class="fa-solid fa-folder"></i>
                @else
                <i class="fa-light fa-folder"></i>
                @endif
                <span>Danh mục</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2 @if(isset($page) && $page=='posts') active @endif" href="{{ route('admin.posts.index') }}">
                @if(isset($page) && $page=='posts')
                <i class="fa-solid fa-blog"></i>
                @else
                <i class="fa-light fa-blog"></i>
                @endif
                <span>Bài đăng</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2" href="{{ route('admin.auth.logout') }}">
                <i class="fa-light fa-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</aside>