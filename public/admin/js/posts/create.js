const languageSelected = document.querySelector(".language-selected");
const languageChoose = document.querySelector(".language-choose");
const languageChooseItems = languageChoose.querySelectorAll("li");
const languageSelect = document.querySelector("#language-select");

document.addEventListener("click", (e) => {
    const outsideClick = languageSelected.contains(e.target);

    if (outsideClick) {
        languageChoose.classList.toggle("none");
    } else {
        languageChoose.classList.add("none");
    }
});

for (let languageChooseItem of languageChooseItems) {
    languageChooseItem.addEventListener("click", () => {
        const languageId = languageChooseItem.dataset.id;
        const languageText = languageChooseItem.textContent;

        addSelectedItem(languageId, languageText);
    });
}

function addSelectedItem(id, name) {
    setValueLanguageSelect(id, true);

    // Create language selected item
    const newSelectedItem = document.createElement("div");
    newSelectedItem.className = "form-control language-selected-item";
    newSelectedItem.id = `_${id}`;
    newSelectedItem.innerHTML = `<span>${name}</span>
                                <span class="icon-remove d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="0.8rem" viewBox="0 0 384 512">
                                        <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                    </svg>
                                </span>`;

    // Add item to language selected box
    languageSelected.appendChild(newSelectedItem);

    // Set event when click on remove btn
    const removeBtn = newSelectedItem.querySelector(".icon-remove");
    removeBtn.onclick = () => {
        removeSelectedItem(id);
    };
}

function removeSelectedItem(id) {
    setValueLanguageSelect(id, false);

    const itemToRemove = languageSelected.querySelector(`#_${id}`);
    if (itemToRemove) {
        itemToRemove.remove();
    }
}

function setValueLanguageSelect(id, isSelected) {
    const listOption = languageSelect.querySelectorAll("option");
    if(isSelected){
        addInvalidSelect(false)
    }
    for (let option of listOption) {
        if (option.value === id) {
            option.selected = isSelected;
        }
    }
   
    setDisableLanguageChooseItem(id);
}

function setDisableLanguageChooseItem(id) {
    for (let languageChooseItem of languageChooseItems) {
        const languageId = languageChooseItem.dataset.id;

        if (languageId == id) {
            languageChooseItem.classList.toggle("disabled");
        }
    }
}
