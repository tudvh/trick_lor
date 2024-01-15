<div class="card mb-5">
    <form class="row g-4" wire:submit="save">
        <h2 class="mb-0 fw-bold">Thiết lập về tôi</h2>

        <div class="col-12 col-md-6">
            <div class="form-group image-chosen-wrapper">
                <label for="image-chosen-file" class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control d-none" id="image-chosen-file" accept="image/*" wire:model="avatarFile">

                <div class="image-chosen-container d-flex gap-3">
                    <div class="image-chosen-content-wrapper">
                        <div class="image-chosen-content">
                            <img src="{{ $avatarUrlPreview ?? url('public/assets/img/user-avatar/user-avatar-default.png') }}" alt="{{ $user->full_name }}">
                            <label for="image-chosen-file" class="image-choose">
                                <div class="icon-box">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button class="btn btn-danger gap-2 remove-image-btn" type="button" wire:click="removeAvatar">
                        <i class="fas fa-trash"></i>
                        <span>Xóa ảnh</span>
                    </button>
                </div>

                @error('avatarFile')
                <div class="mt-2">
                    <small class="text-danger">{{ $message }}</small>
                </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6 d-flex flex-column gap-4">
            <div class="form-group">
                <label for="full-name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control @error('fullName') is-invalid @enderror" id="full-name" autocomplete="off" wire:model="fullName">
                @error('fullName')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" value="{{ $user->email }}" disabled>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success ms-auto mt-4 gap-2">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Cập nhật thông tin</span>
            </button>
        </div>
    </form>

    <div class="loading-overlay" wire:loading wire:target="avatarFile, save" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>

@script
<script>
    $wire.on('update-personal-success', async () => {
        await Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Cập nhật thông tin thành công",
            showConfirmButton: false,
            timer: 1500
        });
        location.reload()
    })
</script>
@endscript