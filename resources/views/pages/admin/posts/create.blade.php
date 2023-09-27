@extends('layouts.admin.main')

@section('title', 'Thêm mới bài đăng')
@section('title-content', 'Thêm mới bài đăng')

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">

<link rel="stylesheet" href="{{ url('public/admin/css/posts/preview.css') }}">
<link rel="stylesheet" href="{{ url('public/admin/css/posts/create.css') }}">
@stop

@section('content')
<form class="needs-validation" method="POST" novalidate action="{{ route('admin.posts.store') }}">
    <div class="row">
        @csrf

        @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" name="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}" required>
                @if($errors->has('title'))
                <small class="text-danger">{{ $errors->first('title') }}</small>
                @else
                <small class="invalid-feedback">Vui lòng nhập tiêu đề</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4 mt-lg-0">
            <div class="form-group">
                <label for="youtube-id">Youtube id</label>
                <!-- <input type="text" class="form-control @if($errors->has('youtube_id')) is-invalid @endif" id="youtube-id" name="youtube_id" value="{{ old('youtube_id') }}" placeholder="Nhập youtube id"> -->
                <input type="text" class="form-control @if($errors->has('youtube_id')) is-invalid @endif" id="youtube-id" name="youtube_id" value="0HaBOFvBoIA" placeholder="Nhập youtube id">
                @if($errors->has('youtube_id'))
                <small class="text-danger">{{ $errors->first('youtube_id') }}</small>
                @else
                <small class="invalid-feedback">Vui lòng nhập youtube id</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group language-box">
                <label for="language-selected">Ngôn ngữ</label>

                @php
                $listLanguagesChosen = old('languages', []);
                @endphp
                <select name="languages[]" id="language-select" class="form-control" multiple hidden required>
                    @foreach($listLanguages as $language)
                    <option value="{{ $language->id }}" {{ in_array($language->id, $listLanguagesChosen) ? 'selected' : '' }}>
                        {{ $language->name }}
                    </option>
                    @endforeach
                </select>

                <div class="form-control language-selected d-flex flex-wrap gap-2" id="language-selected" tabindex="0">
                </div>
                <div class="form-control language-choose none">
                    <ul>
                        @foreach($listLanguages as $language)
                        <li data-id='{{ $language->id }}'>{{ $language->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <small class="invalid-feedback">Vui lòng chọn ngôn ngữ</small>
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select id="status" name="status" class="form-control" required>
                    @php
                    $oldStatus = old('status');
                    @endphp
                    <option value="1" {{ $oldStatus === '1' ? 'selected' : '' }}>Công khai</option>
                    <option value="0" {{ $oldStatus === '0' ? 'selected' : '' }}>Riêng tư</option>
                </select>
                <small class="invalid-feedback">Vui lòng chọn trạng thái</small>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group">
                <label for="youtube-link">Mô tả</label>
                <textarea class="form-control" name="description" id="desc-textarea" rows="10" placeholder="Nhập mô tả" required>{!!old('description')!!}</textarea>
                <small class="invalid-feedback">Vui lòng nhập mô tả</small>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group d-flex gap-3">
                <a class="btn btn-primary show-preview">Xem preview</a>
                <input href="" class="btn btn-success" type="submit" value="Thêm">
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="preview" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <div class="modal fade show" id="preview" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-modal="true" style="display: block;"> -->
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Preview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="preview-loading-overlay">
                    <div class="loading-icon">
                        <i class="fa-solid fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.tiny.cloud/1/{{ $apiKey = env('API_EDITOR'); }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('public/assets/js/tinymce.js') }}"></script>
<script src="{{ url('public/assets/js/prism.js') }}"></script>

<script src="{{ url('public/admin/js/posts/create.js') }}"></script>
<script src="{{ url('public/admin/js/posts/preview.js') }}"></script>

<script>
    // Form validation check
    const form = document.querySelector('form')
    const showPreviewBtn = document.querySelector('.show-preview')

    const formValidation = () => {
        form.classList.add('was-validated');
        return form.checkValidity();
    };

    form.addEventListener('submit', (e) => {
        if (!formValidation()) {
            e.preventDefault();
            e.stopPropagation();
        }
    }, false);

    showPreviewBtn.addEventListener('click', () => {
        if (formValidation()) {
            showModalPreview();
        }
    });
</script>
@stop