@extends('layouts.admin.main')

@section('title', 'Thêm mới bài viết')
@section('title-content', 'Thêm bài đăng')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/posts-create.css') }}">
@stop

@section('content')
<div class="card p-3">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề">
            </div>
            <div class="form-group mt-3">
                <label for="youtube-link">Link youtube</label>
                <input type="text" class="form-control" id="youtube-link" name="youtube_link" placeholder="Nhập link youtube">
            </div>
            <div class="form-group mt-3 language-box">
                <label for="language-box">Ngôn ngữ</label>
                <div class="form-control language d-flex flex-wrap gap-2">
                    <!-- <div class="form-control language-selected d-flex align-items-center">
                        <span>CSS</span>
                        <span class="icon-remove d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="0.8rem" viewBox="0 0 384 512">
                                <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                            </svg>
                        </span>
                    </div> -->
                </div>
                <div class="form-control language-choose none">
                    <ul>
                        @foreach($listLanguage as $language)
                        <li data-id='{{ $language->id }}'>{{ $language->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <select multiple name="languages" id="language-box" class="form-control" hidden>
                    @foreach($listLanguage as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="youtube-link">Mô tả</label>
                <textarea class="form-control" name="" id="" rows="5"></textarea>
            </div>
            <div class="action mt-3 d-flex gap-3">
                <a href="" class="btn btn-outline-secondary">Xem preview</a>
                <a href="" class="btn btn-success">Thêm</a>
            </div>

        </div>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.tiny.cloud/1/x8lr9jtz8dxvdavxa6kvrljyfxuuox94bkdn4knyhhg07dsq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('public/admin/js/createPost.js') }}"></script>
<script>
    tinymce.init({
        selector: "textarea",
        plugins: "tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss preview",
        toolbar: "undo redo | blocks | bold italic underline strikethrough | link image table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | codesample | preview code",
        tinycomments_mode: "embedded",
    });
</script>
@stop