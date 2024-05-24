<div class="modal-content" id="auth-container">
    <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        @if ($screen == 'login')
            <livewire:site.auth.login />
        @elseif($screen == 'register')
            <livewire:site.auth.register />
        @elseif($screen == 'forgot-password')
            <livewire:site.auth.forgot-password />
        @endif
    </div>
</div>

@script
    <script>
        const ROOT_URL = document.querySelector('meta[name="root-url"]').dataset.index
        const authOverlay = document.querySelector('#auth-overlay')

        $wire.on('login-with-google', () => {
            var width = 500
            var height = 700
            var left = (screen.width - width) / 2
            var top = (screen.height - height) / 2
            var params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
                  width=${width},height=${height},left=${left},top=${top}`

            window.open(`${ROOT_URL}/auth/google`, 'myWindow', params)
        })

        authOverlay.addEventListener('hidden.bs.modal', () => {
            $wire.switchScreen('login')
        })
    </script>
@endscript

<script>
    async function receiveDataFromGoogleLoginWindow(data) {
        if (data.status === 'success') {
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
        } else if (data.status === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Thất bại',
                text: data.message,
            })
        }
    }
</script>
