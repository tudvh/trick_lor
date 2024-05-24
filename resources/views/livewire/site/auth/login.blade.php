<div id="login-container">
    <div class="form-container d-flex flex-column gap-3">
        <h1 class="title">Đăng nhập</h1>
        <form class="form d-flex flex-column gap-4" wire:submit="login">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="@error('email') is-invalid @enderror"
                    placeholder="Nhập email..." wire:model="email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" class="@error('password') is-invalid @enderror"
                    placeholder="Nhập mật khẩu..." autocomplete="off" wire:model="password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="forgot ms-auto">
                    <button type="button" wire:click="$parent.switchScreen('forgot-password')">Quên mật khẩu?</button>
                </div>
            </div>
            <button type="submit" class="submit btn btn-success">ĐĂNG NHẬP</button>
        </form>
        <div class="social-message">
            <div class="line"></div>
            <p class="message">Đăng nhập bằng tài khoản khác</p>
            <div class="line"></div>
        </div>
        <div class="social-icons">
            <button type="button" class="icon btn auth-google" wire:click="$dispatch('login-with-google')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="-0.5 0 48 48">
                    <path
                        d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24"
                        id="Fill-1" fill="#FBBC05"></path>
                    <path
                        d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333"
                        id="Fill-2" fill="#EB4335"></path>
                    <path
                        d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667"
                        id="Fill-3" fill="#34A853"></path>
                    <path
                        d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24"
                        id="Fill-4" fill="#4285F4"></path>
                </svg>
            </button>
        </div>
        <p class="signup">Chưa có tài khoản?
            <button type="button" wire:click="$parent.switchScreen('register')"> ĐĂNG KÝ</button>
        </p>
    </div>

    <div class="loading-overlay" wire:loading wire:target="login" wire:loading.class="d-flex">
        <div class="loading-icon">
            <i class="fa-light fa-loader"></i>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('login-success', async () => {
            await Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: toast => {
                    toast.onmouseenter = Swal.stopTimer
                    toast.onmouseleave = Swal.resumeTimer
                },
            }).fire({
                icon: "success",
                title: "Đăng nhập thành công",
            })

            location.reload()
        })
    </script>
@endscript
