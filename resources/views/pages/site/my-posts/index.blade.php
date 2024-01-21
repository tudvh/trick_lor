@extends('layouts.site.header-only')

@section('title', 'Bài đăng của tôi - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post-detail.css') }}">

<link rel="stylesheet" href="{{ url('public/site/css/my-post/index.css') }}">
@stop

@section('content')
<livewire:site.my-posts.index :listCategories="$listCategories" />
@stop

@section('js')
<script src="{{ url('public/assets/js/prism.js') }}"></script>
@stop