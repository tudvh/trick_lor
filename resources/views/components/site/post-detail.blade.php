@php
use \App\Helpers\DateHelper;
use App\Helpers\NumberHelper;
@endphp

<div class="post-header">
    <h2 class="post-title">{{ $post->title }}</h2>
    <div class="d-flex gap-3">
        <span class="post-info">{{ NumberHelper::format($post->postViews->count()) }} lượt xem • {{ DateHelper::formatTimeAgo($post->created_at) }}</span>
        <div class="post-more ms-auto d-flex">
            <livewire:site.post.post-save :postId="$post->id" />
            <button type="button" class="dropdown-toggle post-more-btn" data-bs-toggle="dropdown" aria-expanded="false" title="Chia sẻ">
                <i class="fa-sharp fa-solid fa-share-nodes"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button id="copy-current-link" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                        <div class="icon-box">
                            <i class="fa-solid fa-copy"></i>
                        </div>
                        <span class="w-100">Sao chép liên kết</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="post-category d-flex flex-wrap gap-2 mt-2">
        @foreach($post->postCategories as $postCategory)
        <a href="{{ route('site.category', ['category'=>$postCategory->category->slug]) }}" class="icon-box" title="{{ $postCategory->category->name }}" target="_blank">
            {!! $postCategory->category->icon_color !!}
        </a>
        @endforeach
    </div>
</div>

@if($post->youtube_id)
<div class="video-container">
    <iframe class="post-video" type="text/html" frameborder="0" src="https://www.youtube-nocookie.com/embed/{{ $post->youtube_id }}?autoplay=1&iv_load_policy=3&loop=1&playlist={{ $post->youtube_id }}&modestbranding=1&rel=0&showinfo=0&vq=hd1080" allowfullscreen></iframe>
</div>
@endif

<div class="post-desc">
    {!! $post->description !!}
</div>