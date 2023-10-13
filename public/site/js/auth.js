const openAuthBtn = document.querySelector('#open-auth-btn')
const authOverlay = document.querySelector('#auth-overlay')
const authModal = new bootstrap.Modal(authOverlay)
const _token = document.querySelector('input[name="_token"]').value
const ROOT_URL = document.querySelector('meta[name="root-url"]').dataset.index

// Login variables
const loginContainer = document.querySelector('#login-container')
const loginForm = loginContainer.querySelector('#login-form')
const switchToRegisterBtn = loginContainer.querySelector('#switch-to-register')
const switchToForgotBtn = loginContainer.querySelector('#switch-to-forgot')
const loginEmailInput = loginContainer.querySelector('#login-email')
const loginPasswordInput = loginContainer.querySelector('#login-password')

// Register variables
const registerContainer = document.querySelector('#register-container')
const registerForm = registerContainer.querySelector('#register-form')
const switchToLoginBtn = registerContainer.querySelector('#switch-to-login')
const registerFullNameInput = registerContainer.querySelector('#register-full-name')
const registerEmailInput = registerContainer.querySelector('#register-email')
const registerPasswordInput = registerContainer.querySelector('#register-password')
const registerPasswordConfirmInput = registerContainer.querySelector('#register-password-confirm')

// Forgot variables
const forgotContainer = document.querySelector('#forgot-container')
const forgotForm = forgotContainer.querySelector('#forgot-form')
const forgotEmailInput = forgotContainer.querySelector('#forgot-email')

// Google variables
const authGoogleBtn = document.querySelectorAll('.auth-google')

// Open register form
const openRegisterForm = () => {
  loginContainer.classList.add('d-none')
  registerContainer.classList.remove('d-none')
}

// Open login form
const openLoginForm = () => {
  loginContainer.classList.remove('d-none')
  registerContainer.classList.add('d-none')
  forgotContainer.classList.add('d-none')
}

// Open forgot form
const openForgotForm = () => {
  loginContainer.classList.add('d-none')
  forgotContainer.classList.remove('d-none')
}

// Open auth overlay
openAuthBtn.addEventListener('click', () => {
  authModal.show()

  switchToRegisterBtn.onclick = openRegisterForm
  switchToLoginBtn.onclick = openLoginForm
  switchToForgotBtn.onclick = openForgotForm
})

// Switch to login form when auth overlay is closed
authOverlay.addEventListener('hidden.bs.modal', openLoginForm)

// Event when login submit
loginForm.onsubmit = e => {
  e.preventDefault()
  showLoadingOverlay()

  axios
    .post(
      `${ROOT_URL}/auth/login`,
      {
        _token,
        email: loginEmailInput.value,
        password: loginPasswordInput.value,
      },
      {
        headers: {
          'Content-Type': 'application/json',
        },
      },
    )
    .then(data => {
      toast({
        title: 'Thành công',
        message: data.data.message,
        type: 'success',
        duration: 5000,
      })
      setTimeout(() => {
        location.reload()
      }, 500)
    })
    .catch(error => {
      toast({
        title: 'Thất bại',
        message: error.response.data.message,
        type: 'error',
        duration: 5000,
      })
    })
    .finally(() => {
      hideLoadingOverlay()
    })
}

// Event when register submit
registerForm.onsubmit = e => {
  e.preventDefault()
  showLoadingOverlay()

  axios
    .post(
      `${ROOT_URL}/auth/register`,
      {
        _token,
        full_name: registerFullNameInput.value,
        email: registerEmailInput.value,
        password: registerPasswordInput.value,
        password_confirm: registerPasswordConfirmInput.value,
      },
      {
        headers: {
          'Content-Type': 'application/json',
        },
      },
    )
    .then(data => {
      toast({
        title: 'Thành công',
        message: data.data.message,
        type: 'success',
        duration: 5000,
      })
      setTimeout(() => {
        location.reload()
      }, 500)
    })
    .catch(error => {
      toast({
        title: 'Thất bại',
        message: error.response.data.message,
        type: 'error',
        duration: 5000,
      })
    })
    .finally(() => {
      hideLoadingOverlay()
    })
}

// Event when forgot password submit
forgotForm.onsubmit = e => {
  e.preventDefault()
  showLoadingOverlay()

  axios
    .post(
      `${ROOT_URL}/auth/forgot`,
      {
        _token,
        email: forgotEmailInput.value,
      },
      {
        headers: {
          'Content-Type': 'application/json',
        },
      },
    )
    .then(data => {
      toast({
        title: 'Thành công',
        message: data.data.message,
        type: 'success',
        duration: 999999,
      })
    })
    .catch(error => {
      toast({
        title: 'Thất bại',
        message: error.response.data.message,
        type: 'error',
        duration: 999999,
      })
    })
    .finally(() => {
      hideLoadingOverlay()
    })
}

// Auth google
function receiveDataFromGoogleLoginWindow(data) {
  if (data.status === 'success') {
    toast({
      title: 'Thành công',
      message: data.message,
      type: 'success',
      duration: 5000,
    })
    setTimeout(() => {
      location.reload()
    }, 500)
  }
}

Array.from(authGoogleBtn).forEach(btn => {
  btn.addEventListener('click', () => {
    let googleLoginWindow = null

    var width = 500
    var height = 700
    var left = (screen.width - width) / 2
    var top = (screen.height - height) / 2
    var params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
                  width=${width},height=${height},left=${left},top=${top}`

    googleLoginWindow = window.open(`${ROOT_URL}/auth/google`, 'myWindow', params)
  })
})
