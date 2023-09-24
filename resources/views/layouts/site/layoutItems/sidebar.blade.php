<aside>
    <div class="logo-web">
        <a href="{{ route('site.home') }}">
            <img src="{{ url('public/site/img/logo-web.png') }}" alt="Trick loR">
        </a>
    </div>
    <div class="list">
        <ul>
            <li>
                <a class="d-flex align-items-center flex-row gap-3 home-btn @if (isset($page) && $page=='home' ) active @endif" href="{{ route('site.home') }}">
                    <div class="icon-box">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <span class="text-center">Trang chủ</span>
                </a>
            </li>
            <li>
                <a class="d-flex align-items-center flex-row gap-3 home-btn @if (isset($page) && $page=='about' ) active @endif" href="{{ route('site.home') }}">
                    <div class="icon-box">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <span class="text-center">Giới thiệu</span>
                </a>
            </li>
        </ul>

        <ul>
            @foreach($listLanguages as $language)
            <li>
                <a class="d-flex align-items-center flex-row gap-3 @if(isset($page) && $language->slug==$page)  active @endif" href="{{ route('site.language',['language'=>$language->slug]) }}">
                    <div class="icon-box">
                        {!! $language->icon !!}
                    </div>
                    <span class="text-center">{{ $language->name }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</aside>