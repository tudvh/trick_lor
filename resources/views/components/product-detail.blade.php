<?php
use \App\Helpers\DateHelper;

?>

<link rel="stylesheet" href="{{ url('public/site/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">
<div class="row">
    <div class="col-12 col-lg-6">
        <div id="video-box" class="w-100 d-flex justify-content-center">
            <iframe class="video" type="text/html" frameborder="0" style="width: 100%; height: 500px;" src="https://www.youtube-nocookie.com/embed/{{ $post->youtube_id }}?autoplay=1&disablekb=1&fs=0&iv_load_policy=3&loop=1&playlist={{ $post->youtube_id }}&modestbranding=1&rel=0&showinfo=0&vq=hd1080"></iframe>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <div class="d-flex justify-content-end align-items-center mt-3 gap-3" id="action">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mt-4 mt-lg-0 mb-5">
        <h2 class="post-title">{{ $post->title }}</h2>
        
        <div class="d-flex gap-2 mt-2">
            @foreach($post->codes as $code)
            <div class="icon-box">
                {!! $code->language->icon !!}
            </div>
            @endforeach
        </div>
        <div class="mt-5 post-desc">
            {!! $post->description !!}
        </div>
    </div>
</div>




