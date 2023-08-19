@extends('layouts.site.main')

@section('title', 'Trang chủ')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/home.css') }}">
@stop

@section('content')

@if ($listPosts->count() > 0)
<x-list-post :colLg="4" :colSm="6" :listPosts="$listPosts" />
@else
<h3>Chưa có bài đăng!</h3>
@endif

@stop