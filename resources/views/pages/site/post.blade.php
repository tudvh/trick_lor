<?php

use \App\Helpers\DateHelper;
?>

@extends('layouts.site.main')

@section('title', $post->title)

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">
@stop

@section('content')

@if(!$post->active)
<h1>Bài viết không có sẵn</h1>
@else
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
    <iframe class="post-video" type="text/html" frameborder="0" style="width: 100%; height: 500px;" src="https://www.youtube-nocookie.com/embed/{{ $post->youtube_id }}?autoplay=1&iv_load_policy=3&loop=1&playlist={{ $post->youtube_id }}&modestbranding=1&rel=0&showinfo=0&vq=hd1080" allowfullscreen></iframe>
    @endif

    <div class="post-desc">
        {!! $post->description !!}
    </div>
</div>
@endif

@stop

@section('js')
<!-- Prism JS -->
<script src="{{ url('public/assets/js/prism.js') }}"></script>
<script>
    Prism.highlightAll();
</script>

<!-- Local JS -->
<script src="{{ url('public/assets/js/copy-code.js') }}"></script>
<script>
    const videoElement = document.querySelector('.video')

    function setHeightVideo() {
        if (videoElement) {
            const videoAspectRatio = 16 / 9
            const videoWidth = videoElement.offsetWidth

            videoElement.style.height = `${videoWidth / videoAspectRatio}px`
        }
    }

    setHeightVideo()
    window.addEventListener('resize', setHeightVideo)
</script>
@stop