<div class="card">
    <div class="content-header">
        <div class="icon-wrapper">
            <div class="icon-box col-auto">
                <i class="fa-sharp fa-solid fa-fire"></i>
            </div>
        </div>
        <h1 class="fw-bold m-0 col-auto">Phổ biến</h1>
    </div>
    <div class="tabs-title border-bottom">
        <div class="tab-title-item btn {{ $type == 'day' ? 'active' : '' }}" x-on:click="$wire.set('type', 'day')">
            Ngày
        </div>
        <div class="tab-title-item btn {{ $type == 'week' ? 'active' : '' }}" x-on:click="$wire.set('type', 'week')">Tuần
        </div>
        <div class="tab-title-item btn {{ $type == 'month' ? 'active' : '' }}" x-on:click="$wire.set('type', 'month')">
            Tháng</div>
        <div class="tab-title-item btn {{ $type == 'all' ? 'active' : '' }}" x-on:click="$wire.set('type', 'all')">Tất
            cả</div>
    </div>
    <div class="mt-4">
        <x-site.list-post :colLg="4" :colSm="6" :posts="$posts" />
    </div>

    <div class="loading-overlay" wire:loading wire:target="type" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>
