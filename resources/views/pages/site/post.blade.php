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
<link rel="stylesheet" href="{{ url('public/site/css/post-comment.css') }}">
@stop

@section('content')
@if($post->active)
<div class="post-wrapper d-flex flex-column gap-5">
    <div class="d-flex flex-column gap-5 card">
        <x-post-detail :post="$post" />
    </div>

    <div class="card">
        <h2 class="post-title mb-3">Gợi ý</h2>
        <x-site.list-post :colLg="4" :colSm="6" :posts="$suggestedPosts" />
    </div>

    <div class="card">
        <h2 class="post-title mb-3">Bình luận</h2>
        <livewire:site.post.post-comment :postId="$post->id" />
    </div>
</div>
@else
<div class="card h-100">
    <h0>Bài viết không có sẵn</h0>
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