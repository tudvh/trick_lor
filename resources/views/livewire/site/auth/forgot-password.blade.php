<div id="forgot-container">
    <div class="form-container d-flex flex-column gap-3">
        <h1 class="title">Quên mật khẩu</h1>
        <form class="form d-flex flex-column gap-4" wire:submit="forgot">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" class="@error('email') is-invalid @enderror"
                    placeholder="Nhập email của bạn..." wire:model="email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="forgot ms-auto">
                    <button type="button" wire:click="$parent.switchScreen('forgot-password')">Đăng nhập</button>
                </div>
            </div>
            <button type="submit" class="submit">XÁC NHẬN</button>
        </form>
    </div>

    <div class="loading-overlay" wire:loading wire:target="forgot" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('handle-forgot-success', async () => {
            await Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: 'Chúng tôi đã gửi một tin nhắn đến địa chỉ email của bạn. Vui lòng kiểm tra email để tiếp tục.',
            })

            $wire.dispatch('switch-screen', {
                screen: 'login'
            });
        })
    </script>
@endscript
