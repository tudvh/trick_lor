@php
use \App\Helpers\DateHelper;
use \App\Helpers\NumberHelper;
@endphp

<div class="d-flex flex-column gap-4 card">
    <h2 class="m-0 fw-bold">Danh sách người dùng</h2>

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
            <select class="form-select" wire:model.live="searchStatus">
                <option value="">Trạng thái</option>
                <option value="registered">Đã đăng ký</option>
                <option value="verified">Đang xác nhận</option>
                <option value="blocked">Bị cấm</option>
            </select>
        </div>
        <div class="col-md-auto">
            <button type="button" class="btn btn-primary gap-2" wire:click="refreshFilter">
                <i class="fa-solid fa-rotate"></i>
                <span>Làm mới</span>
            </button>
        </div>
    </form>

    @if ($users->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th>Số lượng bài đăng</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td class="user-avatar" title="{{ $user->full_name }}">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-container">
                                <div class="avatar-box">
                                    <img src="{{ $user->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ $user->full_name }}">
                                </div>
                            </div>
                            <span class="post-author-full-name">{{ $user->full_name }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->status == 'registered')
                        <span class='badge bg-warning'>Đã đăng ký</span>
                        @elseif($user->status == 'verified')
                        <span class='badge bg-success'>Đã xác nhận</span>
                        @elseif($user->status == 'blocked')
                        <span class='badge bg-danger'>Bị cấm</span>
                        @endif
                    </td>
                    <td>{{ NumberHelper::format($user->posts->count()) }}</td>
                    <td>{{ DateHelper::convertDateFormat($user->created_at) }}</td>
                    <td>
                        <div class='d-flex justify-content-center align-items-center gap-2'>
                            @if($user->status == 'verified')
                            <button type="button" class='btn btn-danger' title="Cấm người dùng" wire:click="$dispatch('show-confirm-ban-user', {userId: {{ $user->id }}})">
                                <i class="fa-light fa-lock"></i>
                            </button>
                            @elseif($user->status == 'blocked')
                            <button type="button" class='btn btn-success' title="Gỡ lệnh cấm người dùng" wire:click="$dispatch('show-confirm-un-ban-user', {userId: {{ $user->id }}})">
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
    <h4 class="text-center m-0">Danh sách người dùng trống</h4>
    @endif

    {{ $users->links('partials.paginate-custom-livewire') }}

    <div class="loading-overlay" wire:loading wire:target="searchKey, searchStatus, refreshFilter, setPage, banUser, unBanUser" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>

@script
<script>
    // Event confirm ban user
    $wire.on('show-confirm-ban-user', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn cấm người dùng này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.banUser(e.userId)
        }
    })

    // Event confirm un ban user
    $wire.on('show-confirm-un-ban-user', async (e) => {
        const result = await Swal.fire({
            title: "Bạn chắc chứ",
            text: "Bạn có chắc muốn gỡ lệnh cấm người dùng này không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Chắc chắn",
            cancelButtonText: "Hủy"
        })

        if (result.isConfirmed) {
            $wire.unBanUser(e.userId)
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