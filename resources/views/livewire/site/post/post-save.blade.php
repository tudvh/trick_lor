<div>
    @if($save)
    <button type="button" class="post-more-btn" title="Hủy lưu bài viết" style="color: var(--color-primary)" wire:click="unSavePost">
        <i class="fa-solid fa-bookmark"></i>
    </button>
    @else
    <button type="button" class="post-more-btn" title="Lưu bài viết" wire:click="savePost">
        <i class="fa-regular fa-bookmark"></i>
    </button>
    @endif

    <div class="loading-overlay" wire:loading wire:target="savePost, unSavePost" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>