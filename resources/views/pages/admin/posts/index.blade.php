@extends('layouts.admin.main')

@section('title', 'Danh sách bài đăng')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ url('site/css/post-detail.css') }}">

    <link rel="stylesheet" href="{{ url('adm/css/posts/index.css') }}">
@stop

@section('content')
    <livewire:admin.posts.index :listCategories="$listCategories" />
@stop

@section('js')
    <script src="{{ url('assets/js/prism.js') }}"></script>
@stop
