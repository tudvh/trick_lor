@extends('layouts.admin.main')

@section('title', 'Danh sách danh mục')
@section('title-content', 'Danh sách danh mục')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/categories/index.css') }}">
@stop

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Tên danh mục</th>
                    <th>Icon</th>
                    <th>Icon color</th>
                    <th>Số lượng bài đăng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <th>{{ $category->id }}</th>
                    <td title="{{ $category->name }}">{{ $category->name }}</td>
                    <td>
                        <div class="icon-box ms-auto me-auto">{!! $category->icon !!}</div>
                    </td>
                    <td>
                        <div class="icon-box ms-auto me-auto">{!! $category->icon_color !!}</div>
                    </td>
                    <td>{{ $category->postCategories()->count() }}</td>
                    <td>
                        <div class='d-flex justify-content-center align-items-center gap-2'>
                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class='btn btn-primary' title="Chỉnh sửa danh mục">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $categories->withQueryString()->links('partials.paginate-custom', ['onEachSide' => 3]) }}
</div>
@stop

@section('action')
<a class="btn btn-success gap-2 ms-auto" href="{{ route('admin.categories.create') }}">
    <i class="fa-solid fa-plus"></i>
    <span>Thêm mới</span>
</a>
@stop

@section('js')
@stop