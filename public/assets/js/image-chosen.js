const imageFileInput = document.querySelector('#image-chosen-file')
const imageContentWrapper = document.querySelector('.image-chosen-content')
const removeImageBtn = document.querySelector('.remove-image-btn')
const isRemoveImageCheckbox = document.querySelector('#is-remove-image')

const createImageContent = url => {
  const imageContent = document.createElement('img')
  imageContent.src = url
  return imageContent
}

const removeImage = () => {
  imageContentWrapper.innerHTML = ''
  imageFileInput.value = ''
  isRemoveImageCheckbox.checked = true
}

imageFileInput.addEventListener('change', e => {
  const imageFile = e.target.files[0]

  if (imageFile) {
    let imageUrl = window.URL.createObjectURL(imageFile)
    imageContentWrapper.innerHTML = ''
    imageContentWrapper.appendChild(createImageContent(imageUrl))
    isRemoveImageCheckbox.checked = false
  } else {
    removeImage()
  }
})

removeImageBtn.addEventListener('click', () => {
  removeImage()
})
