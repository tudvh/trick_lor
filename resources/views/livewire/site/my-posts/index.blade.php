@php
use \App\Helpers\DateHelper;
use \App\Helpers\NumberHelper;
@endphp

<div class="container">
    <div class="content">
        <div class="card d-flex flex-column gap-4">
            <h2 class="mb-0 fw-bold">Bài đăng của tôi</h2>

            @if (session('success'))
            <div class="alert alert-success m-0">
                {{ session('success') }}
            </div>
            @endif

            <form class="d-flex flex-wrap algin-items-center gap-2 gap-md-3">
                <div class="col-12 col-md-auto">
                    <input type="text" class="form-control" autocomplete="off" placeholder="Tìm kiếm..." wire:model.live.debounce="searchKey">
                </div>
                <div class="col-12 col-md-auto">
                    <select class="form-select" wire:model.live="searchCategory">
                        <option value="">Danh mục</option>
                        @foreach($listCategories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-auto">
                    <select class="form-select" wire:model.live="searchStatus">
                        <option value="">Chế độ hiển thị</option>
                        <option value="waiting">Đang chờ duyệt</option>
                        <option value="public">Công khai</option>
                        <option value="private">Riêng tư</option>
                        <option value="blocked">Bị cấm</option>
                    </select>
                </div>
                <div class="col-12 col-md-auto">
                    <select class="form-select" wire:model.live="sortBy">
                        <option value="latest">Mới nhất</option>
                        <option value="most-popular">Phổ biến nhất</option>
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="button" class="btn btn-primary gap-2" wire:click="refreshFilter">
                        <i class="fa-solid fa-rotate"></i>
                        <span>Làm mới</span>
                    </button>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('site.my-posts.create') }}" class="btn btn-success gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span>Thêm mới bài đăng</span>
                    </a>
                </div>
            </form>

            @if ($posts->count() > 0)
            <div class="d-flex flex-column gap-5">
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Youtube Id</th>
                                <th>Chế độ hiển thị</th>
                                <th>Ngày tạo</th>
                                <th>Lượt xem</th>
                                <th>Lượt bình luận</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td class="post-title" title="{{ $post->title }}">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="thumbnail-container">
                                            <div class="thumbnail-box">
                                                @if($post->thumbnails_custom)
                                                <x-thumbnail :thumbnails="$post->thumbnails_custom" :alt="$post->title" />
                                                @elseif($post->thumbnails)
                                                <x-thumbnail :thumbnails="$post->thumbnails" :alt="$post->title" />
                                                @else
                                                <img src="{{ url('public/admin/img/post-default.png') }}">
                                                @endif
                                            </div>
                                        </div>
                                        <span>{{ $post->title }}</span>
                                    </div>
                                </td>
                                <td class="post-category">
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        @foreach($post->categories as $category)
                                        <div class="icon-box" title="{{ $category->name }}">
                                            {!! $category->icon_color !!}
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ $post->youtube_id }}</td>
                                <td>
                                    @if($post->status == 'waiting')
                                    <span class='badge bg-warning'>Đang chờ duyệt</span>
                                    @elseif($post->status == 'public')
                                    <span class='badge bg-success'>Công khai</span>
                                    @elseif($post->status == 'private')
                                    <span class='badge bg-secondary'>Riêng tư</span>
                                    @elseif($post->status == 'blocked')
                                    <span class='badge bg-danger'>Bị cấm</span>
                                    @endif
                                </td>
                                <td>{{ DateHelper::convertDateFormat($post->created_at) }}</td>
                                <td>{{ NumberHelper::format($post->postViews->count()) }}</td>
                                <td>{{ NumberHelper::format($post->postComments->count()) }}</td>
                                <td>
                                    <div class='d-flex justify-content-center align-items-center gap-2'>
                                        <a href="{{ route('site.my-posts.edit', ['post' => $post->id]) }}" class='btn btn-primary' title="Chỉnh sửa bài đăng">
                                            <i class="fa-light fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" class='btn btn-info' title="Preview" wire:click="preview('{{ $post->id }}')">
                                            <i class="fa-light fa-eye"></i>
                                        </button>
                                        <button type="button" class='btn btn-danger' title="Xóa bài đăng" wire:click="$dispatch('show-confirm-delete-post', {postId: {{ $post->id }}})">
                                            <i class="fa-light fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $posts->links('partials.paginate-custom-livewire') }}
            </div>
            @else
            <h4 class="text-center m-0">Danh sách bài đăng trống</h4>
            @endif

            <div class="modal fade" id="preview" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content h-100">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Preview</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body post-wrapper d-flex flex-column gap-5"></div>
                    </div>
                </div>
            </div>

            <div class="loading-overlay" wire:loading wire:target="searchKey, searchCategory, searchStatus, sortBy, refreshFilter, setPage, preview, delete" wire:loading.class="d-flex">
                <div class="loading-icon">
                    <i class="fa-light fa-loader"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    // Preview
    previewWrapper = document.querySelector('#preview')
    previewBody = previewWrapper.querySelector('.modal-body')
    previewModal = new bootstrap.Modal(previewWrapper, {});

    $wire.on('preview', (e) => {
        previewBody.innerHTML = e.dataPreview
        previewModal.show()
        Prism.highlightAll();
    })

    previewWrapper.addEventListener('hidden.bs.modal', event => {
        previewBody.innerHTML = ''
    })

    // Event confirm delete post
    $wire.on('show-confirm-delete-post', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn xóa bài đăng này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.delete(e.postId)
        }
    })

    // Event when delete successfully
    $wire.on('delete-success', async () => {
        await Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Xóa bài đăng thành công",
            showConfirmButton: false,
            timer: 2000
        })
    })
</script>
@endscript