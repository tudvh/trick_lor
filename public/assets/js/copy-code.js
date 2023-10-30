const createCopyCodeBtn = () => {
  const copyCodeBtn = document.createElement('button')
  copyCodeBtn.className = 'copy-code-btn'
  copyCodeBtn.textContent = 'Copy'
  return copyCodeBtn
}

const handleCopyCode = async (copyCodeBtn, codeContainer) => {
  const codeContent = codeContainer.textContent

  try {
    if (navigator.clipboard) {
      await navigator.clipboard.writeText(codeContent)
    } else {
      const tempInput = document.createElement('input')
      tempInput.value = codeContent
      document.body.appendChild(tempInput)
      tempInput.select()
      document.execCommand('copy')
      document.body.removeChild(tempInput)
    }

    copyCodeBtn.textContent = 'Copied!'
    copyCodeBtn.classList.add('copied')

    setTimeout(() => {
      copyCodeBtn.textContent = 'Copy'
      copyCodeBtn.classList.remove('copied')
    }, 3000)
  } catch (error) {
    console.error('Lỗi khi sao chép code:', error)
    toast({
      title: 'Lỗi',
      message: 'Không thể sao chép code',
      type: 'error',
      duration: 5000,
    })
  }
}

const addCopyCodeBtnToCodeBox = codeBox => {
  const copyCodeBtn = createCopyCodeBtn()
  codeBox.appendChild(copyCodeBtn)

  copyCodeBtn.addEventListener('click', () => {
    const codeContainer = codeBox.querySelector('code')
    handleCopyCode(copyCodeBtn, codeContainer)
  })
}

const addCopyCodeBtnsToAllCodeBoxes = () => {
  const listCodeBox = document.querySelectorAll('pre')
  listCodeBox.forEach(addCopyCodeBtnToCodeBox)
}

addCopyCodeBtnsToAllCodeBoxes()
