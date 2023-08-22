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
<meta name="root-url" data-index="{{ URL::to('/'); }}">
<div class="modal fade" id="alertDelete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">


                    Thông báo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có muốn ẩn bài đăng này không</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button id="accepShow" type="button" class="btn btn-primary">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="content-header d-flex algin-items-center justify-content-between">
        <div class="filter d-flex gap-3">
            <form class="search">
                <input type="text" name="search" autocomplete="off">
                <button class="submit-btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                </button>
            </form>

            <select name="language">

                <option value="">Ngôn ngữ</option>
                @foreach($listLanguage as $language)
                <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach
            </select>
            <select name="status">
                <option value="">Trạng thái</option>
                <option value="1">Đang hoạt động</option>
                <option value="0">Đã ẩn</option>
            </select>
        </div>
        <a class="btn btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <path style="fill:#fff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
            </svg>
            <span>Thêm mới</span>
        </a>
    </div>

    <table class=" table table-striped table-hover mt-4 ">
        <thead>
            <tr>
                <th scope=" col">Id</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Youtube Id</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Hành động</th>

            </tr>
        </thead>
        <tbody class="table-group-divider">

            {!! $postRender !!}

        </tbody>

    </table>

</div>
@stop
@section('js')
<script src="{{ url('public/admin/js/listPost.js') }}"></script>
@stop