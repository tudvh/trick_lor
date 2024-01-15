@php
use \App\Helpers\DateHelper;
use \App\Helpers\NumberHelper;
@endphp


@extends('layouts.site.header-only')

@section('title', 'Bài đăng của tôi - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/my-post/index.css') }}">
@stop

@section('content')
<div class="card d-flex flex-column gap-4">
    <h2 class="mb-0 fw-bold">Bài đăng của tôi</h2>

    <div class="d-flex flex-column gap-4">
        @if (session('success'))
        <div class="alert alert-success m-0">
            {{ session('success') }}
        </div>
        @endif

        <form class="d-flex flex-wrap algin-items-center gap-2 gap-md-3">
            <div class="col-12 col-md-auto">
                <input class="form-control" type="text" name="search-key" autocomplete="off" placeholder="Tìm kiếm...">
            </div>
            <div class="col-12 col-md-auto">
                <select name="category" class="form-select">
                    <option value="">Danh mục</option>
                    @foreach($listCategories as $category)
                    <option value="{{ $category->slug }}" {{ request()->input('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <select name="status" class="form-select">
                    <option value="">Chế độ hiển thị</option>
                    <option value="public" {{ request()->input('status') == 'waiting' ? 'selected' : '' }}>Đang chờ duyệt</option>
                    <option value="public" {{ request()->input('status') == 'public' ? 'selected' : '' }}>Công khai</option>
                    <option value="private" {{ request()->input('status') == 'private' ? 'selected' : '' }}>Riêng tư</option>
                    <option value="blocked" {{ request()->input('status') == 'blocked' ? 'selected' : '' }}>Bị cấm</option>
                </select>
            </div>
            <div class="col-md-auto">
                <button class="btn btn-info gap-2" type="submit">
                    <i class="fa-solid fa-filter"></i>
                    <span>Lọc</span>
                </button>
            </div>
            <div class="col-md-auto">
                <a href="{{ route('site.my-posts.index') }}" class="btn btn-primary gap-2" type="button">
                    <i class="fa-solid fa-rotate"></i>
                    <span>Làm mới</span>
                </a>
            </div>
            <div class="col-md-auto">
                <a href="{{ route('site.my-posts.create') }}" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm mới bài đăng</span>
                </a>
            </div>
        </form>

        @if ($posts->count() > 0)
        <div class="d-flex flex-column gap-5">
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Youtube Id</th>
                            <th>Chế độ hiển thị</th>
                            <th>Ngày tạo</th>
                            <th>Lượt xem</th>
                            <th>Lượt bình luận</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td class="post-title" title="{{ $post->title }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="thumbnail-container">
                                        <div class="thumbnail-box">
                                            @if($post->thumbnails_custom)
                                            <x-thumbnail :thumbnails="$post->thumbnails_custom" :alt="$post->title" />
                                            @elseif($post->thumbnails)
                                            <x-thumbnail :thumbnails="$post->thumbnails" :alt="$post->title" />
                                            @else
                                            <img src="{{ url('public/admin/img/post-default.png') }}">
                                            @endif
                                        </div>
                                    </div>
                                    <span class="post-title-text">{{ $post->title }}</span>
                                </div>
                            </td>
                            <td class="post-category">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    @foreach($post->categories as $category)
                                    <div class="icon-box" title="{{ $category->name }}">
                                        {!! $category->icon_color !!}
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $post->youtube_id }}</td>
                            <td>
                                @if($post->status == 'waiting')
                                <span class='badge bg-warning'>Đang chờ duyệt</span>
                                @elseif($post->status == 'public')
                                <span class='badge bg-success'>Công khai</span>
                                @elseif($post->status == 'private')
                                <span class='badge bg-secondary'>Riêng tư</span>
                                @elseif($post->status == 'blocked')
                                <span class='badge bg-danger'>Bị cấm</span>
                                @endif
                            </td>
                            <td>{{ DateHelper::convertDateFormat($post->created_at) }}</td>
                            <td>{{ NumberHelper::format($post->postViews->count()) }}</td>
                            <td>{{ NumberHelper::format($post->postComments->count()) }}</td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center gap-2'>
                                    <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class='btn btn-primary' title="Chỉnh sửa bài đăng">
                                        <i class="fa-light fa-pen-to-square"></i>
                                    </a>
                                    <button class='btn btn-info' title="Preview">
                                        <i class="fa-light fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $posts->withQueryString()->links('partials.paginate-custom', ['onEachSide' => 3]) }}
        </div>
        @else
        <h4 class="text-center m-0">Danh sách bài đăng trống</h4>
        @endif
    </div>
</div>
@stop

@section('js')
@stop