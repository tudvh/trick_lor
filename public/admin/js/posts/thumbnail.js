const thumbnailInput = document.querySelector('#thumbnail')
const thumbnailInputFake = document.querySelector('#thumbnail-fake')
const thumbnailContentWrapper = document.querySelector('.thumbnail-content')
const removeThumbnailBtn = document.querySelector('.remove-thumbnail-btn')
const isRemoveThumbnailCheckbox = document.querySelector('#is-remove-thumbnail')

const createImageContent = url => {
  const imageContent = document.createElement('img')
  imageContent.src = url
  return imageContent
}

thumbnailInputFake.addEventListener('change', e => {
  const imageFile = e.target.files[0]

  if (imageFile) {
    let imageUrl = window.URL.createObjectURL(imageFile)
    thumbnailContentWrapper.appendChild(createImageContent(imageUrl))

    isRemoveThumbnailCheckbox.checked = false
    thumbnailInput.files = thumbnailInputFake.files
  }
})

removeThumbnailBtn.addEventListener('click', () => {
  thumbnailContentWrapper.innerHTML = ''
  thumbnailInput.value = ''
  thumbnailInputFake.value = ''
  isRemoveThumbnailCheckbox.checked = true
  console.log(isRemoveThumbnailCheckbox)
})
