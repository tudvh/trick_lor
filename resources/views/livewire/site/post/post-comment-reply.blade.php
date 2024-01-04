@php
use App\Helpers\DateHelper
@endphp

<div class="comment-reply-wrapper d-flex flex-column gap-3">
    @if($user)
    <form class="form-comment d-flex gap-2" wire:submit="sendCommentReply">
        <div class="user-avatar">
            <img src="{{ $user->avatar ?? 'https://storage.googleapis.com/laravel-img.appspot.com/user/customer-default.png' }}" alt="{{ $user->full_name }}">
        </div>
        <textarea class="form-control comment-write" rows="1" wire:model="commentReplyContent" placeholder="Viết phản hồi..."></textarea>
        <div class="d-flex align-items-start">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-paper-plane-top"></i>
            </button>
        </div>
    </form>
    @endif

    @foreach($commentReplies as $comment)
    <div class="comment-item-wrapper d-flex flex-column gap-2">
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
                    <button type="button" wire:click="$parent.confirmDelete({{ $comment->id }})">Xóa</button>
                    @endif
                    <span>{{ DateHelper::formatTimeAgo($comment->created_at) }}</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if ($commentReplies->hasMorePages())
    <button wire:click="loadMore" class="load-more-comment text-start ms-2">
        <i class="fa-solid fa-turn-down-right"></i>
        <span class="ms-2">Xem thêm phản hồi</span>
    </button>
    @endif

    <div class="loading-overlay" wire:loading wire:target="sendCommentReply" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>