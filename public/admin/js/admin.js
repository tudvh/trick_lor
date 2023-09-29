const loadingOverlay = document.querySelector('.loading-overlay')

const showLoadingOverlay = () => {
  loadingOverlay.classList.remove('none')
}

const closeLoadingOverlay = () => {
  loadingOverlay.classList.add('none')
}
