const loadingOverlay = document.querySelector('.loading-overlay')

const showLoadingOverlay = () => {
  loadingOverlay.classList.remove('d-none')
  document.body.classList.add('no-scroll')
}

const hideLoadingOverlay = () => {
  loadingOverlay.classList.add('d-none')
  document.body.classList.remove('no-scroll')
}

window.addEventListener('showAlert', e => {
  Swal.fire({
    icon: e.detail[0].icon,
    title: e.detail[0].title,
    text: e.detail[0].text,
  })
})
