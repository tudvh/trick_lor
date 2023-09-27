<aside>
    <a class="logo-header" href="{{ route('admin.dashboard') }}">
        <h2>Trick loR Admin</h2>
    </a>

    <ul class="d-flex flex-column mt-3 gap-1">
        <li>
            <a class="d-flex align-items-center gap-2 @if(isset($page) && $page=='dashboard') active @endif" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2 @if(isset($page) && $page=='posts') active @endif" href="{{ route('admin.posts.index') }}">
                <i class="fa-solid fa-blog"></i>
                <span>Bài đăng</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2" href="{{ route('admin.logout') }}">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</aside>