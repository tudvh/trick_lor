@extends('layouts.site.header-only')

@section('meta')
    <meta property="og:description" content="">
    <meta property="og:image" content="{{ $user->avatar }}">
@stop

@section('title', $user->full_name . ' - Trick loR')

@section('css')
    <link rel="stylesheet" href="{{ url('public/site/css/list-post.css') }}">
    <link rel="stylesheet" href="{{ url('public/site/css/profile.css') }}">
@stop

@section('content')
    <livewire:site.profile :user="$user" :listCategories="$listCategories" />
@stop

@section('js')
@stop
