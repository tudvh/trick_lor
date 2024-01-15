<div class="card">
    <form class="row g-4" wire:submit="save">
        <h2 class="mb-0 fw-bold">Thêm mới bài đăng</h2>

        <div class="col-12">
            <div class="d-flex justify-content-end gap-3">
                <button type="button" class="btn btn-primary gap-2">
                    <i class="fa-solid fa-eye"></i>
                    <span>Preview</span>
                </button>
                <button type="submit" class="btn btn-success gap-2">
                    <i class="fa-solid fa-check"></i>
                    <span>Tạo mới</span>
                </button>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Nhập tiêu đề" autocomplete="off" wire:model="title">
                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="youtube-id" class="form-label">Youtube id</label>
                <input type="text" class="form-control @error('youtubeId') is-invalid @enderror" id="youtube-id" placeholder="Nhập youtube id" autocomplete="off" wire:model.blur="youtubeId">
                @error('youtubeId')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="categories" class="form-label">Danh mục <span class="text-danger">*</span></label>
                <div id="categories" wire:ignore></div>
                @error('categories')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group image-chosen-wrapper">
                <label for="image-chosen-file" class="form-label">Thumbnail tủy chỉnh</label>
                <input type="file" class="form-control @error('thumbnailCustomFile') is-invalid @enderror" id="image-chosen-file" accept="image/*" wire:model="thumbnailCustomFile">
                @error('thumbnailCustomFile')<small class="text-danger">{{ $message }}</small>@enderror

                <div class="image-chosen-container d-flex gap-3 mt-2">
                    <div class="image-chosen-content-wrapper">
                        <div class="image-chosen-content">
                            <img src="{{ $thumbnailCustomUrlPreview ?? url('public/admin/img/post-default.png') }}">
                        </div>
                    </div>

                    <button class="btn btn-danger gap-2 remove-image-btn" type="button" wire:click="removeThumbnailCustom">
                        <i class="fas fa-trash"></i>
                        <span>Xóa ảnh</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group" wire:ignore.self>
                <label for="description" class="form-label">Mô tả <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Nhập mô tả" wire:model="description">{{ $description }}</textarea>
                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
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
                <div class="modal-body post-wrapper d-flex flex-column gap-5"></div>
            </div>
        </div>
    </div>

    <div class="loading-overlay" wire:loading wire:target="thumbnailCustomFile, youtubeId, save" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>

@script
<script>
    const descriptionInit = () => {
        tinymce.init({
            selector: '#description',
            placeholder: 'Nhập mô tả',
            height: 'calc(100vh - var(--header-height) - 234px)',
            block_formats: 'Header 2=h2;Header 3=h3;Header 4=h4;Paragraph=p',
            plugins: 'tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss preview fullscreen',
            toolbar: 'undo redo | blocks | bold italic underline strikethrough | link image table | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | codesample preview code fullscreen',
            tinycomments_mode: 'embedded',
            setup: function(editor) {
                editor.on('blur', function() {
                    $wire.setDescription(editor.getContent());
                })
            }
        })
    }

    const categoriesInit = async (allCategories) => {
        allCategories = allCategories.map((category) => {
            return {
                'value': category.id,
                'label': category.name
            }
        })

        VirtualSelect.init({
            ele: '#categories',
            multiple: true,
            showSelectedOptionsFirst: true,
            showValueAsTags: true,
            required: true,
            placeholder: 'Chọn danh mục',
            options: allCategories,
            name: 'categories'
        });

        document.querySelector('#categories').addEventListener('change', async function() {
            $wire.setCategories(this.value);
        });
    }

    $wire.on('init', async (e) => {
        const allCategories = e.allCategories;

        setTimeout(() => categoriesInit(allCategories), 500)
        setTimeout(descriptionInit, 500)
    })
</script>
@endscript