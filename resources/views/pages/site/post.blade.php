@php
use App\Helpers\ThumbnailHelper;
@endphp

@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
<meta property="og:image" content="{{ ThumbnailHelper::getThumbnail($post)[2] }}">
@stop

@section('title', $post->title . ' - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/list-post.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">
@stop

@section('content')

@if(!$post->active)
<h1>Bài viết không có sẵn</h1>
@else
<div class="post-wrapper d-flex flex-column gap-5">
    <x-post-detail :post="$post" />

    <hr>

    <div class="post-suggest">
        <h2 class="post-title">Bài đăng tương tự</h2>
        <x-site.list-post :colLg="4" :colSm="6" :posts="$suggestedPosts" />
    </div>

    <hr>

    <div class="post-comment">
        <h2 class="post-title">Bình luận</h2>
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
<script src="{{ url('public/site/js/post.js') }}"></script>
@stop