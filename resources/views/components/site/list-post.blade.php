@php
    use App\Helpers\DateHelper;
    use App\Helpers\ThumbnailHelper;
    use App\Helpers\NumberHelper;
@endphp

@php
    $showAuthor = $showAuthor ?? true;
    $showAuthor = filter_var($showAuthor, FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="list-post row">
    @foreach ($posts as $index => $post)
        <div class="col-12 col-sm-{{ $colSm }} col-lg-{{ $colLg }} item" title="{{ $post->title }}">
            <a href="{{ route('site.post', ['post' => $post->slug]) }}">
                <div class="thumbnail-box rounded">
                    <x-thumbnail :thumbnails="ThumbnailHelper::getThumbnail($post)" :alt="$post->title" class="thumbnail" />
                </div>
            </a>
            <div class="d-flex align-items-start gap-2 mt-2">
                @if ($showAuthor)
                    <a href="{{ route('site.profile', ['username' => $post->author->username]) }}" class="mt-1"
                        title="{{ $post->author->full_name }}">
                        <img src="{{ $post->author->avatar ?? url('assets/img/user-avatar/user-avatar-default.png') }}"
                            alt="{{ $post->author->full_name }}" class="avatar rounded-circle">
                    </a>
                @endif
                <a href="{{ route('site.post', ['post' => $post->slug]) }}" class="info">
                    <h3 class="title">{{ $post->title }}</h3>
                    <span href="{{ route('site.profile', ['username' => $post->author->username]) }}"
                        class="author-name" title="{{ $post->author->full_name }}">
                        {{ $post->author->full_name }}
                    </span>
                    <span class="mb-1">
                        {{ NumberHelper::formatView($post->post_views_count) }} lượt xem •
                        {{ DateHelper::formatTimeAgo($post->created_at) }}
                    </span>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($post->categories as $category)
                            <div class="icon-box" title="{{ $category->name }}">
                                {!! $category->icon_color !!}
                            </div>
                        @endforeach
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>
