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
  Swal.fire({
    position: 'top-end',
    icon: e.detail[0].icon,
    title: e.detail[0].title,
    showConfirmButton: false,
    timer: e.detail[0].timer,
  })
})
