@php
use App\Helpers\DateHelper;
use App\Helpers\ThumbnailHelper;
use App\Helpers\NumberHelper;
@endphp

<div class="list-post row">
    @foreach ($posts as $index => $post)
    <div class="item col-12 col-sm-{{ $colSm }} col-lg-{{ $colLg }}" title="{{ $post->title }}">
        <a href="{{ route('site.post', ['post' => $post->slug]) }}">
            <div class="img-box">
                <x-thumbnail :thumbnails="ThumbnailHelper::getThumbnail($post, $index % 2 == 0 ? 'primary' : 'secondary')" :alt="$post->title" />
            </div>
            <div class="info">
                <h3 class="title">{{ $post->title }}</h3>
                <span>{{ NumberHelper::formatView($post->postViews->count()) }} lượt xem • {{ DateHelper::formatTimeAgo($post->created_at) }}</span>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($post->postCategories as $postCategory)
                    <div class="icon-box" title="{{ $postCategory->category->name }}">{!! $postCategory->category->icon_color !!}</div>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>