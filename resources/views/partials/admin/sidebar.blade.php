<aside>
    <a class="logo-header" href="{{ route('admin.dashboard') }}">
        <h2>Trick loR Admin</h2>
    </a>

    <ul class="d-flex flex-column mt-3 pt-0 gap-1">
        <li>
            <div class="mb-3 pb-3 user-panel">
                <a class="d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                    <img src="{{ auth()->guard('admin')->user()->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}"
                        alt="{{ auth()->guard('admin')->user()->full_name }}">
                    <span>{{ auth()->guard('admin')->user()->full_name }}</span>
                </a>
            </div>
        </li>

        <li>
            <a class="d-flex align-items-center gap-2 @if (request()->is('admin')) {{ 'active' }} @endif"
                href="{{ route('admin.dashboard') }}">
                @if (request()->is('admin'))
                    <i class="fa-solid fa-gauge-high nav-icon"></i>
                @else
                    <i class="fa-light fa-gauge-high nav-icon"></i>
                @endif
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2 @if (request()->is('admin/categories*')) {{ 'active' }} @endif"
                href="{{ route('admin.categories.index') }}">
                @if (request()->is('admin/categories*'))
                    <i class="fa-solid fa-layer-group nav-icon"></i>
                @else
                    <i class="fa-light fa-layer-group nav-icon"></i>
                @endif
                <span>Danh mục</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2 @if (request()->is('admin/posts*')) {{ 'active' }} @endif"
                href="{{ route('admin.posts.index') }}">
                @if (request()->is('admin/posts*'))
                    <i class="fa-solid fa-blog nav-icon"></i>
                @else
                    <i class="fa-light fa-blog nav-icon"></i>
                @endif
                <span>Bài đăng</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2 @if (request()->is('admin/users*')) {{ 'active' }} @endif"
                href="{{ route('admin.users.index') }}">
                @if (request()->is('admin/users*'))
                    <i class="fa-solid fa-users nav-icon"></i>
                @else
                    <i class="fa-light fa-users nav-icon"></i>
                @endif
                <span>Người dùng</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2 @if (request()->is('admin/comments*')) {{ 'active' }} @endif"
                href="{{ route('admin.comments.index') }}">
                @if (request()->is('admin/comments*'))
                    <i class="fa-solid fa-message-lines nav-icon"></i>
                @else
                    <i class="fa-light fa-message-lines nav-icon"></i>
                @endif
                <span>Bình luận</span>
            </a>
        </li>
        <li>
            <a class="d-flex align-items-center gap-2" href="{{ route('admin.auth.logout') }}">
                <i class="fa-light fa-right-from-bracket nav-icon"></i>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</aside>
