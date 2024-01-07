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
