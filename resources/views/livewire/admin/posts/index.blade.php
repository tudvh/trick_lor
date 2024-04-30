@php
    use App\Helpers\DateHelper;
    use App\Helpers\NumberHelper;
    use App\Helpers\ThumbnailHelper;
    use App\Enums\Post\PostStatus;
    use App\Enums\Post\PostStatusText;
@endphp

<div class="d-flex flex-column gap-4 card">
    <h2 class="m-0 fw-bold">Danh sách bài đăng</h2>

    <form class="d-flex flex-wrap algin-items-center gap-2 gap-md-3">
        <div class="col-12 col-md-auto">
            <input type="text" class="form-control" autocomplete="off" placeholder="Tìm kiếm..."
                wire:model.live.debounce="searchKey">
        </div>
        <div class="col-12 col-md-auto">
            <select class="form-select" wire:model.live="searchCategory">
                <option value="">Danh mục</option>
                @foreach ($listCategories as $category)
                    <option value="{{ $category->slug }}" {{ $searchCategory === $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-auto">
            <select class="form-select" wire:model.live="searchStatus">
                <option value="">Trạng thái</option>
                @foreach (PostStatus::getValues() as $index => $id)
                    <option value="{{ $id }}" {{ $searchStatus === $id ? 'selected' : '' }}>
                        {{ PostStatusText::getValues()[$index] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-auto">
            <button type="button" class="btn btn-primary gap-2" wire:click="refreshFilter">
                <i class="fa-solid fa-rotate"></i>
                <span>Làm mới</span>
            </button>
        </div>
    </form>

    @if (!$posts->count())
        <h4 class="text-center m-0">Danh sách bài đăng trống</h4>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead class="table-secondary">
                    <x-admin.table-header :columns="$columns" :sortColumn="$sortColumn" :sortType="$sortType" />
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th>{{ $post->id }}</th>
                            <td class="post-title" title="{{ $post->title }}">
                                <div class="d-flex align-items-center gap-2">
                                    <x-thumbnail :thumbnails="ThumbnailHelper::getThumbnail($post)" :alt="$post->title" class="thumbnail rounded" />
                                    <span>{{ $post->title }}</span>
                                </div>
                            </td>
                            <td class="post-author" title="{{ $post->author->full_name }}">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $post->author->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}"
                                        alt="{{ $post->author->full_name }}" class="avatar rounded-circle">
                                    <span>{{ $post->author->full_name }}</span>
                                </div>
                            </td>
                            <td class="post-category">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    @foreach ($post->categories as $category)
                                        <div class="icon-box" title="{{ $category->name }}">
                                            {!! $category->icon_color !!}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                @if ($post->status == PostStatus::WAITING)
                                    <span class='badge bg-warning'>Đang chờ duyệt</span>
                                @elseif($post->status == PostStatus::PUBLIC)
                                    <span class='badge bg-success'>Công khai</span>
                                @elseif($post->status == PostStatus::PRIVATE)
                                    <span class='badge bg-secondary'>Riêng tư</span>
                                @elseif($post->status == PostStatus::BLOCKED)
                                    <span class='badge bg-danger'>Bị cấm</span>
                                @endif
                            </td>
                            <td>{{ DateHelper::convertDateFormat($post->created_at) }}</td>
                            <td>{{ NumberHelper::format($post->post_views_count) }}</td>
                            <td>{{ NumberHelper::format($post->post_comments_count) }}</td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center gap-2'>
                                    <button type="button" class='btn btn-primary' title="Preview"
                                        wire:click="preview('{{ $post->id }}')">
                                        <i class="fa-light fa-eye"></i>
                                    </button>
                                    @if ($post->status == PostStatus::WAITING)
                                        <button type="button" class='btn btn-success' title="Duyệt bài đăng"
                                            wire:click="$dispatch('show-confirm-approve-post', {postId: {{ $post->id }}})">
                                            <i class="fa-light fa-check"></i>
                                        </button>
                                        <button type="button" class='btn btn-danger' title="Không duyệt bài đăng"
                                            wire:click="$dispatch('show-confirm-refuse-post', {postId: {{ $post->id }}})">
                                            <i class="fa-light fa-xmark"></i>
                                        </button>
                                    @elseif($post->status == PostStatus::PUBLIC || $post->status == PostStatus::PRIVATE)
                                        <button type="button" class='btn btn-danger' title="Cấm bài đăng"
                                            wire:click="$dispatch('show-confirm-ban-post', {postId: {{ $post->id }}})">
                                            <i class="fa-light fa-lock"></i>
                                        </button>
                                    @elseif($post->status == PostStatus::BLOCKED)
                                        <button type="button" class='btn btn-success' title="Gỡ lệnh cấm bài đăng"
                                            wire:click="$dispatch('show-confirm-un-ban-post', {postId: {{ $post->id }}})">
                                            <i class="fa-light fa-unlock"></i>
                                        </button>
                                    @endif
                                    <a href="{{ route('admin.comments.index', ['post-id' => $post->id]) }}"
                                        type="button" class='btn btn-info'
                                        title="Xem danh sách bình luận của bài đăng này">
                                        <i class="fa-light fa-message-lines"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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

    <div class="loading-overlay" wire:loading
        wire:target="searchKey, searchCategory, searchStatus, sort, refreshFilter, setPage, preview, approvePost, refusePost, banPost, unBanPost"
        wire:loading.class="d-flex">
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

        $wire.on('show-preview', (e) => {
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

        // Event confirm un ban post
        $wire.on('show-confirm-un-ban-post', async (e) => {
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
    </script>
@endscript
