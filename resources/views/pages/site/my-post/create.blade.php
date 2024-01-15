@extends('layouts.site.header-only')

@section('title', 'Thêm mới bài đăng - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/assets/css/virtual-select.min.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">

<link rel="stylesheet" href="{{ url('public/assets/css/image-chosen.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/my-post/preview.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/my-post/create.css') }}">

<script src="{{ url('public/assets/js/virtual-select.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@stop

@section('content')
<livewire:site.my-post.create :allCategories="$listCategories" />
@stop

@section('js')
<script src="{{ url('public/assets/js/prism.js') }}"></script>
@stop