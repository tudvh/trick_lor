const dialogBox = document.querySelector('#post-toggle-status-dialog')
const dialogContentBox = dialogBox.querySelector('.modal-body p')
const dialogAcceptBtn = dialogBox.querySelector('#accept-btn')
const dialogModal = new bootstrap.Modal(dialogBox, {})

const callApiToToggleStatus = postId => {
  showLoadingOverlay()

  fetch(`${rootURL}/admin/posts/${postId}/toggle-status`)
    .then(response => response.text())
    .then(response => {
      const postElement = document.querySelector(`table tr[data-post-id="${postId}"]`)
      postElement.innerHTML = response

      toast({
        title: 'Thành công',
        message: 'Thay đổi trạng thái bài đăng thành công',
        type: 'success',
        duration: 5000,
      })
    })
    .catch(() => {
      toast({
        title: 'Có lỗi',
        message: 'Có lỗi trong lúc thay đổi trạng thái bài đăng. Vui lòng thử lại sau',
        type: 'error',
        duration: 5000,
      })
    })
    .finally(() => {
      hideLoadingOverlay()
    })
}

const setContentDialog = string => {
  dialogContentBox.innerHTML = string
}

const togglePostStatus = (postId, isShow) => {
  dialogModal.show()

  if (isShow) {
    setContentDialog(
      'Bạn có chắc muốn chuyển sang chế độ <span class="text-success fw-bold">công khai</span> không?',
    )
  } else {
    setContentDialog(
      'Bạn có chắc muốn chuyển sang chế độ <span class="text-danger fw-bold">riêng tư</span> không?',
    )
  }

  dialogAcceptBtn.onclick = () => {
    callApiToToggleStatus(postId)
    dialogModal.hide()
  }
}
