const loadingOverlay = document.querySelector('.loading-overlay')

const showLoadingOverlay = () => {
  loadingOverlay.classList.remove('none')
}

const hideLoadingOverlay = () => {
  loadingOverlay.classList.add('none')
}
