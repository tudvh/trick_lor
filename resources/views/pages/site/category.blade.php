@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
<meta property="og:image" content="{{ url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
@stop

@section('title', $category->name . ' - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/list-post.css') }}">
@stop

@section('content')
<div class="content-header border-bottom pb-3">
    <div class="icon-wrapper">
        <div class="icon-box col-auto">
            {!! $category->icon !!}
        </div>
    </div>
    <h1 class="fw-bold m-0 col-auto">{{ $category->name }}</h1>
</div>
@if ($listPosts->count() > 0)
<x-list-post :colLg="4" :colSm="6" :listPosts="$listPosts" />
@else
<h3 class="mt-3">Danh sách bài đăng trống!</h3>
@endif
@stop