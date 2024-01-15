const copyCurrentLinkBtn = document.querySelector('#copy-current-link')

copyCurrentLinkBtn.addEventListener('click', async () => {
  const currentLink = window.location.href

  try {
    if (navigator.clipboard) {
      await navigator.clipboard.writeText(currentLink)
    } else {
      const tempInput = document.createElement('input')
      tempInput.value = currentLink
      document.body.appendChild(tempInput)
      tempInput.select()
      document.execCommand('copy')
      document.body.removeChild(tempInput)
    }

    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Sao chép liên kết thành công',
      showConfirmButton: false,
      timer: 1000,
    })
  } catch (error) {
    console.error('Lỗi khi sao chép liên kết:', error)
    Swal.fire({
      icon: 'error',
      title: 'Lỗi',
      text: 'Có lỗi trong lúc sao chép liên kết. Vui lòng thử lại',
    })
  }
})
