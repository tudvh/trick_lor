@php
use App\Helpers\ThumbnailHelper;
use \App\Helpers\DateHelper;
use App\Helpers\NumberHelper;
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
<link rel="stylesheet" href="{{ url('public/site/css/post-detail.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post-comment.css') }}">
@stop

@section('content')
<div class="post-wrapper d-flex flex-column gap-5">
    <div class="d-flex flex-column gap-5 card">
        <div class="post-header">
            <h2 class="post-title">{{ $post->title }}</h2>

            <div class="post-category d-flex flex-wrap gap-2 mt-2">
                @foreach($post->categories as $category)
                <a href="{{ route('site.category', ['category' => $category->slug]) }}" class="icon-box" title="{{ $category->name }}" target="_blank">
                    {!! $category->icon_color !!}
                </a>
                @endforeach
            </div>

            <div class="d-flex align-items-center gap-3 mt-3">
                <a href="{{ route('site.profile', ['username' => $post->author->username]) }}" class="post-author">
                    <div class="avatar-container" title="{{ $post->author->full_name }}">
                        <div class="avatar-box">
                            <img src="{{ $post->author->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ $post->author->full_name }}">
                        </div>
                    </div>
                </a>
                <div class="d-flex flex-column justify-content-center">
                    <a href="{{ route('site.profile', ['username' => $post->author->username]) }}" class="fw-bold m-0" title="{{ $post->author->full_name }}">
                        {{ $post->author->full_name }}
                    </a>
                    <span class="post-info">
                        {{ NumberHelper::format($post->postViews->count()) }} lượt xem • {{ DateHelper::formatTimeAgo($post->created_at) }}
                    </span>
                </div>
                <div class="post-more ms-auto d-flex">
                    <livewire:site.post.post-save :postId="$post->id" />
                    <button type="button" class="dropdown-toggle post-more-btn" data-bs-toggle="dropdown" aria-expanded="false" title="Chia sẻ">
                        <i class="fa-sharp fa-solid fa-share-nodes"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <button id="copy-current-link" class="dropdown-item d-flex justify-content-center align-items-center gap-3">
                                <div class="icon-box">
                                    <i class="fa-solid fa-copy"></i>
                                </div>
                                <span class="w-100">Sao chép liên kết</span>
                            </button>
                        </li>
                    </ul>
                </div>
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

    <div class="card">
        <h2 class="post-title mb-3">Đề xuất</h2>
        <x-site.list-post :colLg="4" :colSm="6" :posts="$suggestedPosts" />
    </div>

    <div class="card">
        <h2 class="post-title mb-3">Bình luận</h2>
        <livewire:site.post.post-comment :postId="$post->id" />
    </div>
</div>
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