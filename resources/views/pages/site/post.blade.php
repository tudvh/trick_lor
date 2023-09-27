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
<x-post-detail :post="$post" />
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