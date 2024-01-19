@extends('layouts.admin.main')

@section('title', 'Danh sách bài đăng')

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">

<link rel="stylesheet" href="{{ url('public/admin/css/posts/index.css') }}">
@stop

@section('content')
<livewire:admin.post.index :listCategories="$listCategories" />
@stop

@section('js')
<script src="{{ url('public/assets/js/prism.js') }}"></script>
@stop