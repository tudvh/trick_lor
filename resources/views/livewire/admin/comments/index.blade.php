@php
use \App\Helpers\DateHelper;
use \App\Helpers\NumberHelper;
@endphp

<div class="d-flex flex-column gap-4 card">
    <h2 class="fw-bold">Danh sách bình luận</h2>

    @if (session('success'))
    <div class="alert alert-success m-0">
        {{ session('success') }}
    </div>
    @endif

    <form class="d-flex flex-wrap algin-items-center gap-2 gap-md-3">
        <div class="col-12 col-md-auto">
            <div class="form-group">
                <label for="search-key" class="form-label fw-bold m-0">Tìm kiếm</label>
                <input type="text" id="search-key" class="form-control" autocomplete="off" placeholder="Nhập từ khóa tìm kiếm..." wire:model.live.debounce="searchKey">
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <div class="form-group">
                <label for="search-comment-id" class="form-label fw-bold m-0">Id bình luận</label>
                <input type="text" id="search-comment-id" class="form-control" autocomplete="off" placeholder="Nhập id bình luận..." wire:model.live.debounce="searchCommentId">
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <div class="form-group">
                <label for="search-user-id" class="form-label fw-bold m-0">Id người dùng</label>
                <input type="text" id="search-user-id" class="form-control" autocomplete="off" placeholder="Nhập id người dùng..." wire:model.live.debounce="searchUserId">
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <div class="form-group">
                <label for="search-post-id" class="form-label fw-bold m-0">Id bài đăng</label>
                <input type="text" id="search-post-id" class="form-control" autocomplete="off" placeholder="Nhập id bài đăng..." wire:model.live.debounce="searchPostId">
            </div>
        </div>
        <div class="col-md-auto">
            <div class="d-flex align-items-end h-100">
                <button type="button" class="btn btn-primary gap-2" wire:click="refreshFilter">
                    <i class="fa-solid fa-rotate"></i>
                    <span>Làm mới</span>
                </button>
            </div>
        </div>
    </form>

    @if ($postComments->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Bài đăng</th>
                    <th>Người bình luận</th>
                    <th>Trả lời cho bình luận</th>
                    <th>Nội dung</th>
                    <th>Ngày bình luận</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postComments as $comment)
                <tr>
                    <th>{{ $comment->id }}</th>
                    <td class="comment-post" title="{{ $comment->post->title }}">
                        <div class="d-flex align-items-center gap-2">
                            <div class="thumbnail-container">
                                <div class="thumbnail-box">
                                    @if($comment->post->thumbnails_custom)
                                    <x-thumbnail :thumbnails="$comment->post->thumbnails_custom" :alt="$comment->post->title" />
                                    @elseif($comment->post->thumbnails)
                                    <x-thumbnail :thumbnails="$comment->post->thumbnails" :alt="$comment->post->title" />
                                    @else
                                    <img src="{{ url('public/admin/img/post-default.png') }}" class="thumbnail-content-default" alt="{{ $comment->post->title }}">
                                    @endif
                                </div>
                            </div>
                            <button type="button" class="a text-start" wire:click="setSearchPostId({{ $comment->post->id }})" title="Xem danh sách bình luận của bài đăng {{ $comment->post->title }}">
                                <span>{{ $comment->post->title }}</span>
                            </button>
                        </div>
                    </td>
                    <td class="comment-user" title="{{ $comment->user->full_name }}">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-container">
                                <div class="avatar-box">
                                    <img src="{{ $comment->user->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ $comment->user->full_name }}">
                                </div>
                            </div>
                            <button type="button" class="a text-start" wire:click="setSearchUserId({{ $comment->user->id }})" title="Xem danh sách bình luận của người dùng {{ $comment->user->full_name }}">
                                <span>{{ $comment->user->full_name }}</span>
                            </button>
                        </div>
                    </td>
                    <td>
                        @if($comment->reply_id)
                        <button type="button" class="a comment-link" wire:click="setSearchCommentId({{ $comment->reply_id }})" title="Xem danh sách bình luận của bình luận #{{ $comment->reply_id }}">
                            #{{ $comment->reply_id }}
                        </button>
                        @endif
                    </td>
                    <td class="comment-content">{{ $comment->content }}</td>
                    <td>{{ DateHelper::convertDateFormat($comment->created_at) }}</td>
                    <td>
                        <div class='d-flex justify-content-center align-items-center gap-2'>
                            <button type="button" class='btn btn-danger' title="Xóa bình luận" wire:click="$dispatch('show-confirm-delete-comment', {commentId: {{ $comment->id }}})">
                                <i class="fa-light fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h4 class="text-center m-0">Danh sách bình luận trống</h4>
    @endif

    {{ $postComments->links('partials.paginate-custom-livewire') }}

    <div class="loading-overlay" wire:loading wire:target="searchKey, searchCommentId, searchUserId, searchPostId, setSearchCommentId, setSearchUserId, setSearchPostId, refreshFilter, setPage, delete" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>

@script
<script>
    // Event confirm delete post
    $wire.on('show-confirm-delete-comment', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn xóa bình luận này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.delete(e.commentId)
        }
    })

    // Event when delete successfully
    $wire.on('delete-success', async () => {
        await Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Xóa bình luận thành công",
            showConfirmButton: false,
            timer: 2000
        })
    })
</script>
@endscript