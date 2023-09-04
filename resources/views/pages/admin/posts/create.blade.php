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
    <form class="row needs-validation" method="POST" novalidate action="{{ route('admin.posts.store') }}">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger">
                @if($errors->has('title'))
                    <small class="text-danger">{{$errors->first('title')}}</small>
                    <br />
                @endif   
                @if($errors->has('youtube_id'))
                    
                    <small class="text-danger">{{$errors->first('youtube_id')}}</small>
                @endif  
                    
            </div>
        @endif    
        
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                
                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" required>
                <div id="invalid-feedback-title" class="invalid-feedback" >
                    Vui lòng nhập title!
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4 mt-lg-0">
            <div class="form-group">
                <label for="youtube-link">Link youtube</label>
                <input type="text" class="form-control" id="youtube-link" name="youtube_id" placeholder="Nhập link youtube" required>
                <div class="invalid-feedback">Vui lòng nhập link youtube!</div>
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
                <select multiple name="languages[]" id="language-select" class="form-control" hidden required>
                    @foreach($listLanguage as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>
                
                <small id="select-ivalid" style="color:#dc3545;display:none">Vui lòng chọn ngôn ngữ!</small>
            </div>
        </div>

        <div class="col-12 col-lg-6 mt-4">
            <div class="form-group">
                <label for="youtube-link">Trạng thái</label>
                <select name="status" class="form-control" required>
                    <option value="0">Riêng tư</option>
                    <option value="1" selected>Công khai</option>
                </select>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group">
                <label for="youtube-link">Mô tả</label>
                <textarea class="form-control" name="description" id="desc-textarea" rows="5"></textarea>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="form-group d-flex gap-3">
                <a id="showPreView" class="btn btn-outline-secondary show-preview">Xem preview</a>
                <button href="" class="btn btn-success" type="submit">Thêm</button>
            </div>
        </div>

        
    </form>
</div>

<div class="modal fade" id="preview" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Preview</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="preview-content">
        
      </div>
      
    </div>
  </div>
</div>

@stop

@section('js')

<script src="https://cdn.tiny.cloud/1/{{ $apiKey = env('API_EDITOR'); }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('public/admin/js/editor.js') }}"></script>
<script src="{{ url('public/admin/js/posts/preview.js') }}"></script>






<script src="{{ url('public/admin/js/posts/create.js') }}"></script>

<script>
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const form = document.querySelector('.needs-validation')

    // Loop over them and prevent submission
    
    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
        }
        
        form.classList.add('was-validated')
    }, false)
   
    form.addEventListener('submit', (e)=>{
        
        const valueSelect = document.getElementById('language-select').value
        if(!valueSelect){
            addInvalidSelect(true);
        }else{
            addInvalidSelect(false);   
        }
        
    })
    
    function addInvalidSelect(check){
        
        const elmSelect =document.querySelector(".form-control.language-selected.d-flex.flex-wrap.gap-2")
        const textWarring =document.getElementById('select-ivalid')

        
        check?elmSelect.style.border = '1px solid red':elmSelect.style.border = '';
        check?textWarring.style.display = 'block':textWarring.style.display = 'none';

    }
</script>

    

@stop