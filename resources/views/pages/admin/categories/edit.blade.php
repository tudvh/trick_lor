@extends('layouts.admin.main')

@section('title', 'Cập nhật danh mục')
@section('title-content', 'Cập nhật danh mục')

@section('css')
@stop

@section('content')
<form action="{{ route('admin.categories.update', ['category'=>$category->id]) }}" method="POST">
    <div class="d-flex flex-column gap-4">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $category->id }}">

        @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            <input class="btn btn-success ms-auto" type="submit" value="Lưu thay đổi">
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="Nhập tên danh mục" value="@if(old('name')){{ old('name') }}@else{{ $category->name }}@endif" autocomplete="off" required>
                @if ($errors->has('name'))
                <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                <textarea class="form-control @if($errors->has('icon')) is-invalid @endif" name="icon" id="icon" placeholder="Nhập icon" rows="10" required>@if(old('icon')){{ old('icon') }}@else{{ $category->icon }}@endif</textarea>
                @if ($errors->has('icon'))
                <small class="text-danger">{{ $errors->first('icon') }}</small>
                @endif
            </div>
        </div>
    </div>
</form>
@stop

@section('js')
@stop