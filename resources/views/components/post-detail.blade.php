@php
use \App\Helpers\DateHelper;
@endphp

<div class="post-wrapper d-flex flex-column gap-5">
    <div class="post-header">
        <h2 class="post-title">{{ $post->title }}</h2>
        <span class="post-info">{{ DateHelper::convertDateFormat($post->created_at) }}</span>
        <div class="d-flex flex-wrap gap-2 mt-2">
            @foreach($post->codes as $code)
            <div class="icon-box">
                {!! $code->language->icon !!}
            </div>
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
</div>