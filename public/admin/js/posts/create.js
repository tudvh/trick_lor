const languageSelected = document.querySelector('.language-selected')
const languageChoose = document.querySelector('.language-choose')
const languageChooseItems = languageChoose.querySelectorAll('li')
const languageSelect = document.querySelector('#language-select')

languageSelect.querySelectorAll('option').forEach(option => {
  if (option.selected) {
    addItemElm(option.value, option.innerHTML)
    setDisableLanguageChooseItem(option.value)
  }
})

document.addEventListener('click', e => {
  const isClick = languageSelected.contains(e.target)

  if (isClick) {
    languageChoose.classList.toggle('none')
  } else {
    languageChoose.classList.add('none')
  }
})

// Set even on choose language
for (let languageChooseItem of languageChooseItems) {
  languageChooseItem.addEventListener('click', () => {
    const languageId = languageChooseItem.dataset.id
    const languageName = languageChooseItem.textContent

    handleSelect(languageId, true, languageName)
  })
}

//set selected language
function setSelectedLanguage(id, isSelected) {
  const listOption = languageSelect.querySelectorAll('option')
  for (let option of listOption) {
    if (option.value === id) {
      option.selected = isSelected
    }
  }
}

function handleSelect(id, selected, languageName = '') {
  setDisableLanguageChooseItem(id)
  if (selected == false) {
    //remove value
    setSelectedLanguage(id, false)
    //remove elm
    removeItemElm(id)
  } else {
    //add value
    setSelectedLanguage(id, true)
    //add elm
    addItemElm(id, languageName)
  }
}

// Add item select element
function addItemElm(id, languageName) {
  // Create language selected item
  const newSelectedItem = document.createElement('div')
  newSelectedItem.className = 'form-control language-selected-item'
  newSelectedItem.id = `_${id}`
  newSelectedItem.innerHTML = `<span>${languageName}</span>
                                <span class="icon-remove d-flex align-items-center">
                                  <i class="fa-solid fa-xmark"></i>
                                </span>`

  // Add item to language selected box
  languageSelected.appendChild(newSelectedItem)

  // Set event when click on remove btn
  const removeBtn = newSelectedItem.querySelector('.icon-remove')
  removeBtn.onclick = () => {
    handleSelect(id, false)
  }
}

//remove item select elm
function removeItemElm(id) {
  const itemToRemove = languageSelected.querySelector(`#_${id}`)
  if (itemToRemove) {
    itemToRemove.remove()
  }
}

// Set disable
function setDisableLanguageChooseItem(id) {
  for (let languageChooseItem of languageChooseItems) {
    const languageId = languageChooseItem.dataset.id

    if (languageId == id) {
      languageChooseItem.classList.toggle('disabled')
    }
  }
}
