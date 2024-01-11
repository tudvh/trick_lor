@php
use App\Helpers\DateHelper
@endphp

<div class="comment-wrapper d-flex flex-column gap-3">
    @foreach($comments as $comment)
    <div class="comment-item-wrapper d-flex flex-column gap-2" wire:key="{{ $comment->id }}">
        <div class="comment-item d-flex align-items-start justify-content-start gap-2">
            <div class="user-avatar">
                <img src="{{ $comment->user->avatar ?? 'https://storage.googleapis.com/laravel-img.appspot.com/user/customer-default.png' }}" alt="{{ $comment->user->full_name }}">
            </div>
            <div class="d-flex flex-column gap-1">
                <div class="comment-item-content">
                    <div class="user-name">
                        <p>{{ $comment->user->full_name }}</p>
                    </div>
                    <div class="comment-content">
                        <span>{{ $comment->content }}</span>
                    </div>
                </div>
                <div class="comment-item-more d-flex align-items-center justify-content-start gap-3">
                    @if($user && $user->id == $comment->user_id)
                    <button type="button" wire:click="showReply({{ $comment->id }})">Phản hồi</button>
                    <button type="button" wire:click="$dispatch('show-confirm-delete-comment', {commentId: {{ $comment->id }}})">Xóa</button>
                    @endif
                    <span>{{ DateHelper::formatTimeAgo($comment->created_at) }}</span>
                </div>
            </div>
        </div>

        @if(in_array($comment->id, $commentIdsToShowReply))
        <livewire:site.post.post-comment-reply :commentId="$comment->id" :postId="$postId" :user="$user" key="{{ $comment->id }}-{{ $comment->replies->count() }}" @updated="reRender" />
        @elseif($comment->replies->count() > 0)
        <div class="comment-reply-wrapper d-flex flex-column gap-3">
            <button class="load-more-comment text-start ms-2" wire:click="showReply({{ $comment->id }})">
                <i class="fa-solid fa-turn-down-right"></i>
                <span class="ms-2">Xem phản hồi</span>
            </button>
        </div>
        @endif
    </div>
    @endforeach

    @if ($comments->hasMorePages())
    <button wire:click="loadMore" class="load-more-comment text-start">Xem thêm bình luận</button>
    @endif

    <form class="form-comment d-flex gap-2" wire:submit="sendComment">
        @if($user)
        <div class="user-avatar">
            <img src="{{ $user->avatar ?? 'https://storage.googleapis.com/laravel-img.appspot.com/user/customer-default.png' }}" alt="{{ $user->full_name }}">
        </div>
        @endif
        <textarea class="form-control comment-write" rows="1" placeholder="Viết bình luận..." wire:model="commentContent"></textarea>
        <div class="d-flex align-items-start">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-paper-plane-top"></i>
            </button>
        </div>
    </form>

    <div class="loading-overlay" wire:loading wire:target="sendComment, deleteComment" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>


@script
<script>
    const autoResize = (e) => {
        e.style.height = 'auto';
        e.style.height = `${e.scrollHeight}px`;
    }

    const autoResizeTextAreas = () => {
        document.querySelectorAll('textarea').forEach((textarea) => {
            textarea.removeEventListener('input', autoResize);
            textarea.addEventListener('input', () => autoResize(textarea));
            autoResize(textarea);
        });
    }
    autoResizeTextAreas();

    // Auto resize textarea when typing
    $wire.on('add-event-textarea', () => {
        setTimeout(autoResizeTextAreas, 500)
    })

    // Event confirm delete comment
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
            const commentId = e.commentId
            $wire.deleteComment(commentId)
        }
    })

    // Event pusher
    Pusher.logToConsole = true;
    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: 'ap1'
    });
    var channel = pusher.subscribe('post-{{ $postId }}');
    channel.bind('comment-update', function(data) {
        const userId = '{{ $user ? $user->id : null }}'
        if (userId != data.userId) {
            $wire.reRender()
        } else {
            console.log('no re render');
        }
    })
</script>
@endscript