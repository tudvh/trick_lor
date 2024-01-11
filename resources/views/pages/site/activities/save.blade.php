@php
use App\Helpers\DateHelper;
use App\Helpers\ThumbnailHelper;
use App\Helpers\NumberHelper;
@endphp

@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
<meta property="og:image" content="{{ url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
@stop

@section('title', 'Bài viết đã lưu - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/activity.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/list-post-column.css') }}">
@stop

@section('content')
<div class="d-flex mb-5 activity-tab">
    <a href="{{ route('site.activities.view') }}" class="d-block h-100 @if(request()->is('activities/view')){{ 'active' }}@endif">Bài viết đã xem</a>
    <a href="{{ route('site.activities.save') }}" class="d-block h-100 @if(request()->is('activities/save')){{ 'active' }}@endif">Bài viết đã lưu</a>
</div>

@if ($postSavesPaginator->count() > 0)
<div class="d-flex flex-column gap-5">
    @foreach ($postSavesPaginator as $date => $group)
    <div class="card">
        <p class="fw-bold mb-3" style="font-size: 1.75rem;">{{ $date }}</p>
        <div class="list-post">
            @foreach ($group as $index => $postSave)
            <div class="item" title="{{ $postSave->post->title }}">
                <a href="{{ route('site.post', ['post' => $postSave->post->slug]) }}">
                    <div class="d-flex align-items-start gap-3 w-100">
                        <x-thumbnail :thumbnails="ThumbnailHelper::getThumbnail($postSave->post)" :alt="$postSave->post->title" />
                        <div class="w-100">
                            <p class="title">{{ $postSave->post->title }}</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($postSave->post->postCategories as $postCategory)
                                <div class="icon-box" title="{{ $postCategory->category->name }}">{!! $postCategory->category->icon_color !!}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="hr"></div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<div class="mt-5">
    {{ $postSavesPaginator->withQueryString()->links('partials.paginate-custom', ['onEachSide' => 3]) }}
</div>
@else
<h3>Bạn chưa lưu bài viết nào</h3>
@endif
@stop