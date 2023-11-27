const loadingOverlay = document.querySelector('.loading-overlay')

const showLoadingOverlay = () => {
  loadingOverlay.classList.remove('d-none')
  document.body.classList.add('no-scroll')
}

const hideLoadingOverlay = () => {
  loadingOverlay.classList.add('d-none')
  document.body.classList.remove('no-scroll')
}

window.addEventListener('showToast', e => {
  toast({
    title: e.detail[0].title,
    message: e.detail[0].message,
    type: e.detail[0].type,
    duration: e.detail[0].duration,
  })
})
