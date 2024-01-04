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

      Swal.fire({
        icon: 'success',
        title: 'Thành công',
        text: 'Thay đổi trạng thái bài đăng thành công',
      })
    })
    .catch(() => {
      Swal.fire({
        icon: 'error',
        title: 'Thất bại',
        text: 'Có lỗi trong lúc thay đổi trạng thái bài đăng. Vui lòng thử lại sau',
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
    dialogModal.hide()
    callApiToToggleStatus(postId)
  }
}
