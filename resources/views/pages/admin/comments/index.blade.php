@extends('layouts.admin.main')

@section('title', 'Danh sách bình luận')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/comments/index.css') }}">
@stop

@section('content')
<livewire:admin.comments.index :searchUserId="$searchUserId" :searchPostId="$searchPostId" />
@stop

@section('js')
<script src="{{ url('public/assets/js/prism.js') }}"></script>
@stop