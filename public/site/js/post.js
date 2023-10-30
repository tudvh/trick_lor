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

    toast({
      title: 'Thành công',
      message: 'Sao chép liên kết thành công',
      type: 'success',
      duration: 5000,
    })
  } catch (error) {
    console.error('Lỗi khi sao chép liên kết:', error)
    toast({
      title: 'Lỗi',
      message: 'Không thể sao chép liên kết',
      type: 'error',
      duration: 5000,
    })
  }
})
