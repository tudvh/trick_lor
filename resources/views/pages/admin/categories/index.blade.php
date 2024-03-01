@extends('layouts.admin.main')

@section('title', 'Danh sách danh mục')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/categories/index.css') }}">
@stop

@section('content')

<div class="d-flex flex-column gap-4 card">
    <h2 class="m-0 fw-bold">Danh sách danh mục</h2>

    <a class="btn btn-success gap-2 ms-auto" href="{{ route('admin.categories.create') }}">
        <i class="fa-solid fa-plus"></i>
        <span>Thêm mới</span>
    </a>

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
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <th>{{ $category->id }}</th>
                    <td title="{{ $category->name }}">{{ $category->name }}</td>
                    <td>
                        <div class="icon-box ms-auto me-auto" style="color: var(--color-text);">{!! $category->icon !!}</div>
                    </td>
                    <td>
                        <div class="icon-box ms-auto me-auto">{!! $category->icon_color !!}</div>
                    </td>
                    <td>{{ $category->postCategories->count() }}</td>
                    <td>
                        @if($category->active)
                        <span class='badge bg-success'>Công khai</span>
                        @else
                        <span class='badge bg-secondary'>Riêng tư</span>
                        @endif
                    </td>
                    <td>
                        <div class='d-flex justify-content-center align-items-center gap-2'>
                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class='btn btn-primary' title="Chỉnh sửa danh mục">
                                <i class="fa-light fa-pen-to-square"></i>
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

@section('js')
@stop