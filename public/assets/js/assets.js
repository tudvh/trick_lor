const loadingOverlay = document.querySelector('.loading-overlay')

const showLoadingOverlay = () => {
  loadingOverlay.classList.remove('d-none')
  document.body.classList.add('no-scroll')
}

const hideLoadingOverlay = () => {
  loadingOverlay.classList.add('d-none')
  document.body.classList.remove('no-scroll')
}

window.addEventListener('show-alert', e => {
  Swal.fire({
    icon: e.detail[0].icon,
    title: e.detail[0].title,
    text: e.detail[0].text,
  })
})

window.addEventListener('show-toast', e => {
  Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: toast => {
      toast.onmouseenter = Swal.stopTimer
      toast.onmouseleave = Swal.resumeTimer
    },
  }).fire({
    icon: e.detail[0].icon,
    title: e.detail[0].title,
  })
})
