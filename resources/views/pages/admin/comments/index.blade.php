@extends('layouts.admin.main')

@section('title', 'Danh sách bình luận')

@section('css')
    <link rel="stylesheet" href="{{ url('adm/css/comments/index.css') }}">
@stop

@section('content')
    <livewire:admin.comments.index />
@stop

@section('js')
@stop
