const wrapperBox = document.querySelector(".wrapper");
const sidebarMenuElement = document.querySelector(".sidebar-menu");
const overlayBox = document.querySelector(".overlay");

sidebarMenuElement.addEventListener("click", () => {
    wrapperBox.classList.add("sidebar-open");
    document.body.style.overflowY = "hidden";
});

overlayBox.addEventListener("click", () => {
    wrapperBox.classList.remove("sidebar-open");
    document.body.style.overflowY = "auto";
});
