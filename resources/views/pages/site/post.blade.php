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
<link rel="stylesheet" href="{{ url('public/site/css/home.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">
@stop

@section('content')

@if(!$post->active)
<h1>Bài viết không có sẵn</h1>
@else
<x-post-detail :post="$post" />

<hr class="my-5">

<h2 class="post-title mt-3">Bài đăng tương tự</h2>
<x-list-post :colLg="4" :colSm="6" :listPosts="$suggestedPosts" />

<hr class="my-5">

<h2 class="post-title mt-3">Bình luận</h2>
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
@stop