@php
use \App\Helpers\DateHelper;
use \App\Helpers\NumberHelper;
@endphp

<div class="d-flex flex-column gap-4 card">
    <h2 class="m-0 fw-bold">Danh sách bài đăng</h2>

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
    </form>

    @if ($posts->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Danh mục</th>
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
                    <th>{{ $post->id }}</th>
                    <td class="post-title" title="{{ $post->title }}">
                        <div class="d-flex align-items-center gap-3">
                            <div class="thumbnail-container">
                                <div class="thumbnail-box">
                                    @if($post->thumbnails_custom)
                                    <x-thumbnail :thumbnails="$post->thumbnails_custom" :alt="$post->title" />
                                    @elseif($post->thumbnails)
                                    <x-thumbnail :thumbnails="$post->thumbnails" :alt="$post->title" />
                                    @else
                                    <img src="{{ url('public/admin/img/post-default.png') }}" class="thumbnail-content-default">
                                    @endif
                                </div>
                            </div>
                            <span class="post-title-text">{{ $post->title }}</span>
                        </div>
                    </td>
                    <td class="post-author" title="{{ $post->author->full_name }}">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-container">
                                <div class="avatar-box">
                                    <img src="{{ $post->author->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ $post->author->full_name }}">
                                </div>
                            </div>
                            <span class="post-author-full-name">{{ $post->author->full_name }}</span>
                        </div>
                    </td>
                    <td class="post-category">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach($post->postCategories as $postCategory)
                            <div class="icon-box" title="{{ $postCategory->category->name }}">
                                {!! $postCategory->category->icon_color !!}
                            </div>
                            @endforeach
                        </div>
                    </td>
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
                            <button type="button" class='btn btn-primary' title="Preview" wire:click="preview('{{ $post->id }}')">
                                <i class="fa-light fa-eye"></i>
                            </button>
                            @if($post->status == 'waiting')
                            <button type="button" class='btn btn-success' title="Duyệt bài đăng" wire:click="$dispatch('show-confirm-approve-post', {postId: {{ $post->id }}})">
                                <i class="fa-light fa-check"></i>
                            </button>
                            <button type="button" class='btn btn-danger' title="Không duyệt bài đăng" wire:click="$dispatch('show-confirm-refuse-post', {postId: {{ $post->id }}})">
                                <i class="fa-light fa-xmark"></i>
                            </button>
                            @elseif($post->status == 'public' || $post->status == 'private')
                            <button type="button" class='btn btn-danger' title="Cấm bài đăng" wire:click="$dispatch('show-confirm-ban-post', {postId: {{ $post->id }}})">
                                <i class="fa-light fa-lock"></i>
                            </button>
                            @elseif($post->status == 'blocked')
                            <button type="button" class='btn btn-success' title="Gỡ lệnh cấm bài đăng" wire:click="$dispatch('show-confirm-unBan-post', {postId: {{ $post->id }}})">
                                <i class="fa-light fa-unlock"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h4 class="text-center m-0">Danh sách bài đăng trống</h4>
    @endif

    {{ $posts->links('partials.paginate-custom-livewire') }}

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

    <div class="loading-overlay" wire:loading wire:target="searchKey, searchCategory, searchStatus, sortBy, refreshFilter, setPage, preview, approvePost, refusePost, banPost, unBanPost" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
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

    // Event confirm approve post
    $wire.on('show-confirm-approve-post', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn duyệt bài đăng này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.approvePost(e.postId)
        }
    })

    // Event confirm refuse post
    $wire.on('show-confirm-refuse-post', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn từ chối duyệt bài đăng này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.refusePost(e.postId)
        }
    })

    // Event confirm ban post
    $wire.on('show-confirm-ban-post', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn cấm bài đăng này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.banPost(e.postId)
        }
    })

    // Event confirm ban post
    $wire.on('show-confirm-unBan-post', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn gỡ lệnh cấm bài đăng này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.unBanPost(e.postId)
        }
    })

    // Event when status is updated
    $wire.on('update-status-success', async () => {
        await Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Thành công",
            showConfirmButton: false,
            timer: 2000
        })
    })
</script>
@endscript