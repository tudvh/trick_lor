@extends('layouts.admin.main')

@section('title', 'Cập nhật bài đăng')
@section('title-content', 'Cập nhật bài đăng')

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">

<link rel="stylesheet" href="{{ url('public/admin/css/posts/preview.css') }}">
<link rel="stylesheet" href="{{ url('public/admin/css/posts/create.css') }}">
@stop

@section('content')
<form class="needs-validation" method="POST" novalidate action="{{ route('admin.posts.update', ['post'=>$post->id]) }}" enctype="multipart/form-data">
    <div class="row">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $post->id }}">

        @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            <div class="d-flex gap-3">
                <button class="btn btn-primary show-preview ms-auto" type="button">Xem preview</button>
                <input class="btn btn-success" type="submit" value="Lưu thay đổi">
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group">
                <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" name="title" placeholder="Nhập tiêu đề" value="@if(old('title')){{ old('title') }}@else{{ $post->title }}@endif" autocomplete="off" required>
                @if ($errors->has('title'))
                <small class="text-danger">{{ $errors->first('title') }}</small>
                @else
                <small class="invalid-feedback">Vui lòng nhập tiêu đề</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group">
                <label for="youtube-id" class="form-label">Youtube id</label>
                <input type="text" class="form-control @if($errors->has('youtube_id')) is-invalid @endif" id="youtube-id" name="youtube_id" placeholder="Nhập Youtube id" value="@if(old('youtube_id')){{old('youtube_id')}}@else{{$post->youtube_id}}@endif" autocomplete="off">
                @if ($errors->has('youtube_id'))
                <small class="text-danger">{{ $errors->first('youtube_id') }}</small>
                @else
                <small class="invalid-feedback">Vui lòng nhập youtube id</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group language-box">
                <label for="language-selected" class="form-label">Ngôn ngữ <span class="text-danger">*</span></label>

                @php
                $listLanguagesChosen = old('languages') !== null ? old('languages') : $listLanguagesChosen;
                @endphp
                <select class="form-control @if ($errors->has('languages')) is-invalid @endif" id="language-select" name="languages[]" multiple hidden required>
                    @foreach ($listLanguages as $language)
                    <option value="{{ $language->id }}" {{ in_array($language->id, $listLanguagesChosen) ? 'selected' : '' }}>
                        {{ $language->name }}
                    </option>
                    @endforeach
                </select>

                <div class="form-control language-selected d-flex flex-wrap gap-2" id="language-selected" tabindex="0"></div>
                <div class="form-control language-choose none">
                    <ul>
                        @foreach ($listLanguages as $language)
                        <li data-id='{{ $language->id }}'>{{ $language->name }}</li>
                        @endforeach
                    </ul>
                </div>

                @if ($errors->has('languages'))
                <small class="text-danger">{{ $errors->first('languages') }}</small>
                @else
                <small class="invalid-feedback">Vui lòng chọn ít nhất 1 ngôn ngữ</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group">
                <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                <select class="form-select @if($errors->has('active')) is-invalid @endif" id="active" name="active" required>
                    @php
                    $status = old('status') !== null ? old('status') : $post->active;
                    @endphp
                    <option value="1" @if($status==='1' ) selected @endif>Công khai</option>
                    <option value="0" @if($status==='0' ) selected @endif>Riêng tư</option>
                </select>
                @if ($errors->has('active'))
                <small class="text-danger">{{ $errors->first('active') }}</small>
                @else
                <small class="invalid-feedback">Vui lòng chọn trạng thái</small>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group thumbnail-container">
                <label for="thumbnail" class="form-label">Thumbnail tủy chỉnh</label>
                <input type="file" class="form-control d-none @if($errors->has('thumbnail')) is-invalid @endif" id="thumbnail" name="thumbnail">
                <input type="file" class="form-control d-none" id="thumbnail-fake">
                <input type="checkbox" class="form-check-input d-none" id="is-remove-thumbnail" name="is_remove_thumbnail" value="Remove thumbnail">

                <div class="thumbnail-choose-container gap-3">
                    <div class="thumbnail-content-container">
                        <div class="thumbnail-content-wrapper">
                            <img src="{{ url('public/admin/img/img-default.png') }}" class="thumbnail-content-default">
                            <div class="thumbnail-content">
                                @if($post->thumbnails_custom)
                                <x-thumbnail :thumbnails="$post->thumbnails_custom" :alt="$post->title" />
                                @endif
                            </div>
                            <div class="remove-thumbnail-overlay">
                                <button class="remove-thumbnail-btn" type="button">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button class="thumbnail-choose-btn btn btn-primary" type="button">
                        <label for="thumbnail-fake" class="form-label">Chọn ảnh</label>
                    </button>
                </div>

                @if ($errors->has('thumbnail'))
                <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                @elseif ($errors->any())
                <small class="text-warning">Nếu bạn đã chọn ảnh thumbnail trước đó, vui lòng chọn lại ảnh mới</small>
                @else
                <small class="invalid-feedback">Vui lòng chọn thumbnail</small>
                @endif
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group">
                <label for="desc-textarea" class="form-label">Mô tả <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" id="desc-textarea" placeholder="Nhập mô tả" required>@if(old('description')!==null){!! old('description') !!}@else{!! $post->description !!}@endif</textarea>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="preview" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Preview</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('public/assets/js/tinymce.js') }}"></script>
<script src="{{ url('public/assets/js/prism.js') }}"></script>

<script src="{{ url('public/admin/js/posts/create.js') }}"></script>
<script src="{{ url('public/admin/js/posts/preview.js') }}"></script>
<script src="{{ url('public/admin/js/posts/thumbnail.js') }}"></script>

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