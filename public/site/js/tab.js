const tabsTitleItem = document.querySelectorAll('.tabs-title .tab-title-item')
const tabsListItem = document.querySelectorAll('.tabs-list .tab-list-item')

const resetFilter = () => {
  tabsTitleItem.forEach(button => button.classList.remove('active'))
  tabsListItem.forEach(result => result.classList.add('d-none'))
}

tabsTitleItem.forEach((item, index) => {
  item.addEventListener('click', () => {
    if (!item.classList.contains('active')) {
      resetFilter()
      item.classList.add('active')
      tabsListItem[index].classList.remove('d-none')
    }
  })
})
