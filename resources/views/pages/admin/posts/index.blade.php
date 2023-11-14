@extends('layouts.admin.main')

@section('title', 'Danh sách bài đăng')
@section('title-content', 'Danh sách bài đăng')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/posts/index.css') }}">
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <div class="filter">
        <div class="d-flex flex-wrap justify-content-start algin-items-center gap-2 gap-md-3">
            <div class="col-12 col-md-auto">
                <input class="form-control" type="text" name="search" autocomplete="off" placeholder="Nhập từ khóa tìm kiếm...">
            </div>
            <div class="col-12 col-md-auto">
                <select name="language" class="form-select">
                    <option value="">Danh mục</option>
                    @foreach($listCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <select name="status" class="form-select">
                    <option value="">Chế độ hiển thị</option>
                    <option value="1">Công khai</option>
                    <option value="0">Riêng tư</option>
                </select>
            </div>
            <div class="col-md-auto">
                <button class="btn btn-primary gap-2 refresh-btn">
                    <i class="fa-solid fa-rotate"></i>
                    <span>Làm mới</span>
                </button>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column gap-5" id="data"></div>
</div>

<div class="modal fade" id="post-toggle-status-dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn ẩn bài đăng này không</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="accept-btn">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('action')
<a class="btn btn-success gap-2 ms-auto" href="{{ route('admin.posts.create') }}">
    <i class="fa-solid fa-plus"></i>
    <span>Thêm mới</span>
</a>
@stop

@section('js')
<script src="{{ url('public/admin/js/posts/index.js') }}"></script>
<script src="{{ url('public/admin/js/posts/toggle-status.js') }}"></script>
@stop