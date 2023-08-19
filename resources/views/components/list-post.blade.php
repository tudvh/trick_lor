<?php

use \App\Helpers\DateHelpers;
?>

<div class="wrapper row">
    @foreach($listPosts as $post)
    <div class="item col-12 col-lg-{{ $col }}">
        <a href="">
            <img src="{{url('public/site/img')}}/{{ $post->thumbnails }}" alt="">
            <div class="info">
                <h3 class="title">{{ $post->title }}</h3>
                <span> {{ DateHelpers::convertDateFormat($post->created_at)  }} - 500 view</span>
                <div class="icon-lang d-flex gap-2">
                    @foreach($post->codes as $code)
                    {!! $code->language->icon !!}
                    @endforeach
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>