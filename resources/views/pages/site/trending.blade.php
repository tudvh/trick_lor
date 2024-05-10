@extends('layouts.site.main')

@section('meta')
    <meta property="og:description" content="">
    <meta property="og:image" content="{{ url('assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png') }}">
@stop

@section('title', 'Phổ biến - Trick loR')

@section('css')
    <link rel="stylesheet" href="{{ url('site/css/list-post.css') }}">
@stop

@section('content')
    <livewire:site.trending />
@stop

@section('js')
@stop
