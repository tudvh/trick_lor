@extends('layouts.site.main')

@section('title', 'Trang chủ')

@section('css')
<link rel="stylesheet" href="{{url('public/site/css/home.css')}}">
<link rel="stylesheet" href="{{url('public/site/css/content.css')}}">

@stop

@section('content')

@if ($listPosts->count() <=0) <h1>Chưa có bài đăng!</h1>
    @else
    @foreach($listPosts as $post)
    <x-list-post col="4" :listPosts="$listPosts">

    </x-list-post>
    @endforeach



    </div>
    @endif
    @stop