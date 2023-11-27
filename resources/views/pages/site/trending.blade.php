@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
<meta property="og:image" content="{{ url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
@stop

@section('title', 'Phổ biến - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/list-post.css') }}">
@stop

@section('content')
<div class="card">
    <div class="content-header">
        <div class="icon-wrapper">
            <div class="icon-box col-auto">
                <i class="fa-sharp fa-solid fa-fire"></i>
            </div>
        </div>
        <h1 class="fw-bold m-0 col-auto">Phổ biến</h1>
    </div>
    <div class="tabs-title border-bottom mb-4">
        <div id="tab-title-day" class="tab-title-item btn active">Ngày</div>
        <div id="tab-title-week" class="tab-title-item btn">Tuần</div>
        <div id="tab-title-month" class="tab-title-item btn">Tháng</div>
        <div id="tab-title-all" class="tab-title-item btn">Tất cả</div>
    </div>
    <div class="tabs-list">
        <div id="tab-list-day" class="tab-list-item">
            <x-site.list-post :colLg="4" :colSm="6" :posts="$trendingPostsDay" />
        </div>
        <div id="tab-list-week" class="tab-list-item d-none">
            <x-site.list-post :colLg="4" :colSm="6" :posts="$trendingPostsWeek" />
        </div>
        <div id="tab-list-month" class="tab-list-item d-none">
            <x-site.list-post :colLg="4" :colSm="6" :posts="$trendingPostsMonth" />
        </div>
        <div id="tab-list-all" class="tab-list-item d-none">
            <x-site.list-post :colLg="4" :colSm="6" :posts="$trendingPosts" />
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{ url('public/site/js/tab.js') }}"></script>
@stop