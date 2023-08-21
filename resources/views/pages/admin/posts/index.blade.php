<?php

use \App\Helpers\DateHelper;
?>

@extends('layouts.admin.main')

@section('title', 'Quản lý bài đăng')
@section('title-content', 'Danh sách bài đăng')


@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/posts.css') }}">
@stop

@section('content')
<div class="content-wrapper">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Youtube Id</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->youtube_id }}</td>
                <td>{{ DateHelper::convertDateFormat($post->created_at)  }}</td>
                <td>
                    @if ($post->active)
                    <span class="badge bg-success">Hoạt động</span>
                    @else
                    <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>


            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@stop