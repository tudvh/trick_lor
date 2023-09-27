const openSearchBtn = document.querySelector(".open-search-btn");
const searchWrapper = document.querySelector(".search-wrapper");
const closeSearchBtn = document.querySelector(".close-search-btn");

openSearchBtn.onclick = () => {
    searchWrapper.classList.add("search-open");
};
closeSearchBtn.onclick = () => {
    searchWrapper.classList.remove("search-open");
};
