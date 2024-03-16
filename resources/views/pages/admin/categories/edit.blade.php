@extends('layouts.admin.main')

@section('title', 'Cập nhật danh mục')

@section('css')
@stop

@section('content')
    <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST"
        class="d-flex flex-column gap-4 card">
        <h2 class="m-0 fw-bold">Cập nhật danh mục</h2>

        <div class="col-12 d-flex">
            @if (url()->previous() != url()->current())
                <a href="{{ url()->previous() }}" class="btn btn-primary gap-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Quay lại</span>
                </a>
            @endif
            <button type="submit" class="btn btn-success gap-2 ms-auto">
                <i class="fa-solid fa-check"></i>
                <span>Lưu thay đổi</span>
            </button>
        </div>

        @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success m-0">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @csrf
        @method('PUT')

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label fw-bold">Tên danh mục <span class="text-danger">*</span></label>
                @php
                    $nameValue = old('name') ?? $category->name;
                @endphp
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                    name="name" placeholder="Nhập tên danh mục" value="{{ $nameValue }}" autocomplete="off">
                @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label fw-bold">Slug</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục"
                    value="{{ $category->slug }}" autocomplete="off" disabled>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="icon" class="form-label fw-bold">Icon <span class="text-danger">*</span></label>
                @php
                    $iconValue = old('icon') ?? $category->icon;
                @endphp
                <textarea class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }}" name="icon" id="icon"
                    placeholder="Nhập icon" rows="10">{{ $iconValue }}</textarea>
                @if ($errors->has('icon'))
                    <small class="text-danger">{{ $errors->first('icon') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="icon-color" class="form-label fw-bold">Icon color <span class="text-danger">*</span></label>
                @php
                    $iconColorValue = old('icon_color') ?? $category->icon_color;
                @endphp
                <textarea class="form-control {{ $errors->has('icon_color') ? 'is-invalid' : '' }}" name="icon_color" id="icon-color"
                    placeholder="Nhập icon color" rows="10">{{ $iconColorValue }}</textarea>
                @if ($errors->has('icon_color'))
                    <small class="text-danger">{{ $errors->first('icon_color') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="status" class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                <select class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}" id="status" name="status">
                    @php
                        $statusValue = old('status') ?? $category->status;
                        $statusValue = strval($statusValue);
                    @endphp
                    <option value="1" {{ $statusValue === '1' ? 'selected' : '' }}>Công khai</option>
                    <option value="0" {{ $statusValue === '0' ? 'selected' : '' }}>Riêng tư</option>
                </select>
                @if ($errors->has('status'))
                    <small class="text-danger">{{ $errors->first('status') }}</small>
                @endif
            </div>
        </div>
    </form>
@stop

@section('js')
@stop
