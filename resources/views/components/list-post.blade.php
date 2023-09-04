<?php

use \App\Helpers\DateHelper;
?>

<div class="wrapper row">
    @foreach($listPosts as $post)
    <div class="item col-12 col-sm-{{ $colSm }} col-lg-{{ $colLg }}">
        <a href="{{ route('site.post', ['postSlug' => $post->slug]) }}">
            <div class="img-box">
                <?php
                    $imageThumnail = json_decode($post->thumbnail)[2];
                ?>
                <img src="{{ $imageThumnail }}" alt="">
            </div>
            <div class="info">
                <h3 class="title">{{ $post->title }}</h3>
                <span>{{ DateHelper::convertDateFormat($post->created_at)  }}</span>
                <div class="d-flex gap-2">
                    @foreach($post->codes as $code)
                    <div class="icon-box">
                        {!! $code->language->icon !!}
                    </div>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>