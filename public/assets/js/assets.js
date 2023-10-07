const loadingOverlay = document.querySelector('.loading-overlay')

const showLoadingOverlay = () => {
  loadingOverlay.classList.remove('d-none')
  document.body.classList.add('no-scroll')
}

const hideLoadingOverlay = () => {
  loadingOverlay.classList.add('d-none')
  document.body.classList.remove('no-scroll')
}
