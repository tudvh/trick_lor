@php
    use App\Helpers\DateHelper;
    use App\Helpers\NumberHelper;
    use App\Enums\User\UserStatus;
    use App\Enums\User\UserStatusText;
@endphp

<div class="d-flex flex-column gap-4 card">
    <h2 class="m-0 fw-bold">Danh sách người dùng</h2>

    <form class="d-flex flex-wrap algin-items-center gap-2 gap-md-3">
        <div class="col-12 col-md-auto">
            <input type="text" class="form-control" autocomplete="off" placeholder="Tìm kiếm..."
                wire:model.live.debounce="searchKey">
        </div>
        <div class="col-12 col-md-auto">
            <select class="form-select" wire:model.live="searchStatus">
                <option value="">Trạng thái</option>
                @foreach (UserStatus::getValues() as $index => $id)
                    <option value="{{ $id }}" {{ $searchStatus === $id ? 'selected' : '' }}>
                        {{ UserStatusText::getValues()[$index] }}
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

    @if (!$users->count())
        <h4 class="text-center m-0">Danh sách người dùng trống</h4>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead class="table-secondary">
                    <thead class="table-secondary">
                        <x-admin.table-header :columns="$columns" :sortColumn="$sortColumn" :sortType="$sortType" />
                    </thead>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td class="user" title="{{ $user->full_name }}">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $user->avatar ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}"
                                        alt="{{ $user->full_name }}" class="avatar rounded-circle">
                                    <span>{{ $user->full_name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @if ($user->status == UserStatus::REGISTER)
                                    <span class='badge bg-warning'>Đã đăng ký</span>
                                @elseif($user->status == UserStatus::VERIFIED)
                                    <span class='badge bg-success'>Đã xác nhận</span>
                                @elseif($user->status == UserStatus::BLOCKED)
                                    <span class='badge bg-danger'>Bị cấm</span>
                                @endif
                            </td>
                            <td>{{ NumberHelper::format($user->posts_count) }}</td>
                            <td>{{ DateHelper::convertDateFormat($user->created_at) }}</td>
                            <td>
                                <div class='d-flex justify-content-center align-items-center gap-2'>
                                    <a href="{{ route('admin.comments.index', ['user-id' => $user->id]) }}"
                                        type="button" class='btn btn-info'
                                        title="Xem danh sách bình luận của người dùng này">
                                        <i class="fa-light fa-message-lines"></i>
                                    </a>
                                    @if ($user->status == UserStatus::VERIFIED)
                                        <button type="button" class='btn btn-danger' title="Cấm người dùng"
                                            wire:click="$dispatch('show-confirm-ban-user', {userId: {{ $user->id }}})">
                                            <i class="fa-light fa-lock"></i>
                                        </button>
                                    @elseif($user->status == UserStatus::BLOCKED)
                                        <button type="button" class='btn btn-success' title="Gỡ lệnh cấm người dùng"
                                            wire:click="$dispatch('show-confirm-un-ban-user', {userId: {{ $user->id }}})">
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
    @endif

    {{ $users->links('partials.paginate-custom-livewire') }}

    <div class="loading-overlay" wire:loading
        wire:target="searchKey, searchStatus, sort, refreshFilter, setPage, banUser, unBanUser"
        wire:loading.class="d-flex">
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
    </script>
@endscript
