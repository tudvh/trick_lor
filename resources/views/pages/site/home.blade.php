@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
<meta property="og:image" content="{{ url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
@stop

@section('title', isset($titleWeb) ? $titleWeb . ' - Trick loR' : 'Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/list-post.css') }}">
@stop

@section('content')
@if ($posts->count() > 0)
<div class="card">
    <x-site.list-post :colLg="4" :colSm="6" :posts="$posts" />
</div>
<div class="my-5">
    {{ $posts->withQueryString()->links('partials.paginate-custom', ['onEachSide' => 3]) }}
</div>
@else
<div class="card h-100">
    <h3>Danh sách bài đăng trống!</h3>
</div>
@endif
@stop