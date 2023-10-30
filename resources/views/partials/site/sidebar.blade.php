<aside>
    <div class="logo-web">
        <a href="{{ route('site.home') }}">
            <img src="{{ url('public/site/img/logo-web.png') }}" alt="Trick loR">
        </a>
    </div>
    <div class="list">
        <ul>
            <li>
                <a class="d-flex align-items-center flex-row gap-3 @if (isset($page) && $page=='home') active @endif" href="{{ route('site.home') }}">
                    <div class="icon-box">
                        @if (isset($page) && $page=='home')
                        <i class="fas fa-home-alt"></i>
                        @else
                        <i class="fal fa-home-alt"></i>
                        @endif
                    </div>
                    <span class="text-center">Trang chủ</span>
                </a>
            </li>
            <li>
                <a class="d-flex align-items-center flex-row gap-3 @if (isset($page) && $page=='trending') active @endif" href="{{ route('site.trending') }}">
                    <div class="icon-box">
                        @if (isset($page) && $page=='trending')
                        <i class="fas fa-fire"></i>
                        @else
                        <i class="fal fa-fire"></i>
                        @endif
                    </div>
                    <span class="text-center">Phổ biến</span>
                </a>
            </li>
        </ul>

        <ul>
            @foreach($listCategories as $category)
            <li>
                <a class="d-flex align-items-center flex-row gap-3 @if(isset($page) && $category->slug==$page)  active @endif" href="{{ route('site.category',['category'=>$category->slug]) }}">
                    <div class="icon-box">
                        {!! $category->icon_color !!}
                    </div>
                    <span class="text-center">{{ $category->name }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</aside>