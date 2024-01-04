@php
use App\Helpers\ThumbnailHelper;
@endphp

<form class="search" action="{{ route('site.search') }}">
    <input type="text" name="q" autocomplete="off" placeholder="Tìm kiếm..." wire:model.live.debounce="searchKey" wire:focus="setFocusSearchInput(true)" wire:blur="setFocusSearchInput(false)">
    <div class="search-icon">
        <i class="fa-solid fa-loader search-loading" wire:loading wire:target="searchKey"></i>
        @if($searchKey)
        <i class="fa-solid fa-circle-xmark clear-search" wire:click="clearSearchKey" wire:loading.remove wire:target="searchKey"></i>
        @endif
    </div>
    <span class="span-split"></span>
    <button class="submit-btn" type="submit">
        <i class="fa-regular fa-magnifying-glass"></i>
    </button>
    @if($searchKey && $isFocusSearchInput)
    <ul class="search-result dropdown-menu">
        @if($posts && count($posts) > 0)
        @foreach($posts as $post)
        <li wire:key="{{ $post->id }}" class="d-block">
            <a href="{{ route('site.post', ['post' => $post->slug]) }}" class="dropdown-item">
                <div class="d-flex align-items-center gap-3 w-100" style="height: 73px">
                    <x-thumbnail :thumbnails="ThumbnailHelper::getThumbnail($post)" :alt="$post->title" />
                    <div class="w-100">
                        <h3 class="title">{{ $post->title }}</h3>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($post->postCategories as $postCategory)
                            <div class="icon-box" title="{{ $postCategory->category->name }}">{!! $postCategory->category->icon_color !!}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
        @else
        <li class="px-3">Không có kết quả...</li>
        @endif
    </ul>
    @endif
</form>