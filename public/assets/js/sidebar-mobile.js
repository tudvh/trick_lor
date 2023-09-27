const wrapperBox = document.querySelector('.wrapper')
const sidebarMenuBtn = document.querySelector('.sidebar-menu')
const overlayBox = document.querySelector('.overlay')

sidebarMenuBtn.addEventListener('click', () => {
  wrapperBox.classList.add('sidebar-open')
  document.body.style.overflowY = 'hidden'
})

overlayBox.addEventListener('click', () => {
  wrapperBox.classList.remove('sidebar-open')
  document.body.style.overflowY = 'auto'
})

window.addEventListener('resize', () => {
  if (window.outerWidth > 991) {
    wrapperBox.classList.remove('sidebar-open')
    document.body.style.overflowY = 'auto'
  }
})
