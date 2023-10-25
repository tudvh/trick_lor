@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
<meta property="og:image" content="{{ url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
@stop

@section('title', isset($titleWeb) ? $titleWeb . ' - Trick loR' : 'Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/home.css') }}">
@stop

@section('content')
@if ($listPosts->count() > 0)
<x-list-post :colLg="4" :colSm="6" :listPosts="$listPosts" />
<div class="mt-5">
    {!! $listPosts->withQueryString()->links('partials.paginate-custom', ['onEachSide' => 3]) !!}
</div>
@else
<h3>Danh sách bài đăng trống!</h3>
@endif
@stop