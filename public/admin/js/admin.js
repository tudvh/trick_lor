const loadingOverlay = document.querySelector('.loading-overlay')

export const showLoadingOverlay = () => {
  loadingOverlay.classList.remove('none')
}

export const closeLoadingOverlay = () => {
  loadingOverlay.classList.add('none')
}
