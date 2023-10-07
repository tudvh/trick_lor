const wrapperBox = document.querySelector('.wrapper')
const sidebarMenuBtn = document.querySelector('.sidebar-menu')
const overlayBox = document.querySelector('.overlay')

sidebarMenuBtn.addEventListener('click', () => {
  wrapperBox.classList.add('sidebar-open')
  document.body.classList.add('no-scroll')
})

overlayBox.addEventListener('click', () => {
  wrapperBox.classList.remove('sidebar-open')
  document.body.classList.remove('no-scroll')
})

window.addEventListener('resize', () => {
  if (window.outerWidth > 991 && wrapperBox.classList.contains('sidebar-open')) {
    wrapperBox.classList.remove('sidebar-open')
    document.body.classList.remove('no-scroll')
  }
})
