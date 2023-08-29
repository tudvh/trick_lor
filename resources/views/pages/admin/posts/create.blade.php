@extends('layouts.admin.main')

@section('title', 'Thêm mới bài viết')
@section('title-content', 'Thêm bài đăng')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<link rel="stylesheet" href="{{ url('public/admin/css/posts/create.css') }}">
@stop

@section('content')
<div class="card p-3">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề">
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4 mt-lg-0">
            <div class="form-group">
                <label for="youtube-link">Link youtube</label>
                <input type="text" class="form-control" id="youtube-link" name="youtube_link" placeholder="Nhập link youtube">
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group language-box">
                <label for="language">Ngôn ngữ</label>
                <div class="form-control language-selected d-flex flex-wrap gap-2" id="language-selected">
                </div>
                <div class="form-control language-choose none">
                    <ul>
                        @foreach($listLanguage as $language)
                        <li data-id='{{ $language->id }}'>{{ $language->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <select multiple name="languages[]" id="language-select" class="form-control" hidden>
                    @foreach($listLanguage as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group">
                <label for="youtube-link">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="0">Riêng tư</option>
                    <option value="1" selected>Công khai</option>
                </select>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group">
                <label for="youtube-link">Mô tả</label>
                <textarea class="form-control" name="" id="desc-textarea" rows="5"></textarea>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group d-flex gap-3">
                <a href="" class="btn btn-outline-secondary show-preview">Xem preview</a>
                <a href="" class="btn btn-success">Thêm</a>
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group test-select2">
                <label for="test">Test select 2</label>
                <select name="test[]" class="form-control select2 form-select" id="test" multiple data-placeholder="Select languages">
                    @foreach($listLanguage as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.tiny.cloud/1/x8lr9jtz8dxvdavxa6kvrljyfxuuox94bkdn4knyhhg07dsq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ url('public/admin/js/posts/create.js') }}"></script>
<script>
    tinymce.init({
        selector: "#desc-textarea",
        block_formats: 'Header 4=h4;Paragraph=p',
        plugins: "tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss preview",
        toolbar: "undo redo | blocks | bold italic underline strikethrough | link image table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | codesample preview code",
        tinycomments_mode: "embedded",
    });

    $('.select2').select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2",
        dropdownCssClass: "select2--small",
    })

    const previewBtn = document.querySelector('.show-preview')
    previewBtn.onclick = (e) => {
        e.preventDefault();
        console.log(tinymce.get('desc-textarea').getContent());
    }
</script>
@stop