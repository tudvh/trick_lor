const categorySelected = document.querySelector('.category-selected')
const categoryChoose = document.querySelector('.category-choose')
const categoryChooseItems = categoryChoose.querySelectorAll('li')
const categorySelect = document.querySelector('#category-select')

categorySelect.querySelectorAll('option').forEach(option => {
  if (option.selected) {
    addItemElm(option.value, option.innerHTML)
    setDisablecategoryChooseItem(option.value)
  }
})

document.addEventListener('click', e => {
  const isClick = categorySelected.contains(e.target)

  if (isClick) {
    categoryChoose.classList.toggle('d-none')
  } else {
    categoryChoose.classList.add('d-none')
  }
})

// Set even on choose category
for (let categoryChooseItem of categoryChooseItems) {
  categoryChooseItem.addEventListener('click', () => {
    const categoryId = categoryChooseItem.dataset.id
    const categoryName = categoryChooseItem.textContent

    handleSelect(categoryId, true, categoryName)
  })
}

//set selected category
function setSelectedcategory(id, isSelected) {
  const listOption = categorySelect.querySelectorAll('option')
  for (let option of listOption) {
    if (option.value === id) {
      option.selected = isSelected
    }
  }
}

function handleSelect(id, selected, categoryName = '') {
  setDisablecategoryChooseItem(id)
  if (selected == false) {
    //remove value
    setSelectedcategory(id, false)
    //remove elm
    removeItemElm(id)
  } else {
    //add value
    setSelectedcategory(id, true)
    //add elm
    addItemElm(id, categoryName)
  }
}

// Add item select element
function addItemElm(id, categoryName) {
  // Create category selected item
  const newSelectedItem = document.createElement('div')
  newSelectedItem.className = 'form-control category-selected-item'
  newSelectedItem.id = `_${id}`
  newSelectedItem.innerHTML = `<span>${categoryName}</span>
                                <span class="icon-remove d-flex align-items-center">
                                  <i class="fa-solid fa-xmark"></i>
                                </span>`

  // Add item to category selected box
  categorySelected.appendChild(newSelectedItem)

  // Set event when click on remove btn
  const removeBtn = newSelectedItem.querySelector('.icon-remove')
  removeBtn.onclick = () => {
    handleSelect(id, false)
  }
}

//remove item select elm
function removeItemElm(id) {
  const itemToRemove = categorySelected.querySelector(`#_${id}`)
  if (itemToRemove) {
    itemToRemove.remove()
  }
}

// Set disable
function setDisablecategoryChooseItem(id) {
  for (let categoryChooseItem of categoryChooseItems) {
    const categoryId = categoryChooseItem.dataset.id

    if (categoryId == id) {
      categoryChooseItem.classList.toggle('disabled')
    }
  }
}
