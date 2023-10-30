@extends('layouts.admin.main')

@section('title', 'Thêm mới danh mục')
@section('title-content', 'Thêm mới danh mục')

@section('css')
@stop

@section('content')
<form action="{{ route('admin.categories.store') }}" method="POST">
    <div class="d-flex flex-column gap-4">
        @csrf

        @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Tạo mới">
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label fw-bold">Tên danh mục <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="Nhập tên danh mục" value="{{ old('name') }}" autocomplete="off" required>
                @if ($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="icon" class="form-label fw-bold">Icon <span class="text-danger">*</span></label>
                <textarea class="form-control @if($errors->has('icon')) is-invalid @endif" name="icon" id="icon" placeholder="Nhập icon" rows="10" required>{{ old('icon') }}</textarea>
                @if ($errors->has('icon'))
                <small class="text-danger">{{ $errors->first('icon') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="icon-color" class="form-label fw-bold">Icon color <span class="text-danger">*</span></label>
                <textarea class="form-control @if($errors->has('icon_color')) is-invalid @endif" name="icon_color" id="icon-color" placeholder="Nhập icon color" rows="10" required>{{ old('icon_color') }}</textarea>
                @if ($errors->has('icon_color'))
                <small class="text-danger">{{ $errors->first('icon_color') }}</small>
                @endif
            </div>
        </div>
    </div>
</form>
@stop

@section('js')
@stop