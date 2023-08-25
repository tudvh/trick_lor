const languageBox = document.querySelector(".language");
const languageChoose = document.querySelector(".language-choose");
const listLi = languageChoose.querySelectorAll("li");
const languageSelect = document.querySelector('select[name="languages"]');

document.addEventListener("click", (e) => {
    const outsideClick = document
        .querySelector(".language-box")
        .contains(e.target);

    if (outsideClick) {
        document.querySelector(".language-choose").classList.toggle("none");
    } else {
        document.querySelector(".language-choose").classList.add("none");
    }
});

for (let li of listLi) {
    li.addEventListener("click", () => {
        setSelectLanguage(li.dataset.id, true);
        addShowSelect(li.dataset.id, li.textContent);
    });
}

function setSelectLanguage(id, isSelected) {
    const listOption = languageSelect.querySelectorAll("option");

    for (let option of listOption) {
        if (option.getAttribute("value") == id) {
            option.selected = isSelected;
        }
    }

    setDisableLi(id);
}

function addShowSelect(id, name) {
    languageBox.innerHTML += `<div class="form-control language-selected d-flex align-items-center" id="_${id}">
                                    <span>${name}</span>
                                    <span class="icon-remove d-flex align-items-center" onclick="removeShowSelect(${id})">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="0.8rem" viewBox="0 0 384 512">
                                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                        </svg>
                                    </span>
                                </div>`;
}

function setDisableLi(id) {
    for (let li of listLi) {
        if (li.dataset.id == id) {
            li.classList.toggle("disabled");
        }
    }
}

function removeShowSelect(id) {
    setSelectLanguage(id, false);
    languageBox.querySelector(`#_${id}`).remove();
}
