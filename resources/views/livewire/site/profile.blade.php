@php
use App\Helpers\DateHelper;
@endphp

<div class="profile">
    <div class="profile-header">
        <div class="container">
            <div class="profile-cover" style="background-image: url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png')">
                <div class="profile-cover-shadow"></div>
                <div class="profile-user">
                    <div class="profile-user-avatar-wrapper">
                        <div class="profile-user-avatar-container">
                            <img src="{{ $user->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ $user->full_name }}">
                        </div>
                    </div>
                    <div class="profile-user-name">
                        <span>{{ $user->full_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-content mt-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="card d-flex flex-column gap-3 profile-introduce">
                        <h3 class="fw-bold m-0">Giới thiệu</h3>
                        <div class="d-flex align-items-start gap-2 profile-introduce-item">
                            <i class="fa-solid fa-user-group"></i>
                            <span>Thành viên của <strong>Trick loR</strong> từ {{ DateHelper::formatTimeAgo($user->created_at) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="card d-flex flex-column gap-4 mb-5">
                        <h3 class="fw-bold m-0">Danh sách bài đăng</h3>

                        <div class="d-flex flex-wrap algin-items-center gap-2 gap-md-3 mb-2">
                            <div class="col-12 col-md-auto">
                                <input type="text" class="form-control" placeholder="Tìm kiếm..." wire:model.live.debounce="searchKey">
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
                        </div>

                        @if($posts->count() > 0)
                        <x-site.list-post :colLg="4" :colSm="6" :posts="$posts" />
                        {{ $posts->links('partials.paginate-custom-livewire') }}
                        @else
                        <span>Danh sách bài đăng trống</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loading-overlay" wire:loading wire:target="searchKey, searchCategory, sortBy, refreshFilter, setPage" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>