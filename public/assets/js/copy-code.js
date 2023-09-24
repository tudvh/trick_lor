function createCopyCodeBtn() {
    const copyCodeBtn = document.createElement("button");
    copyCodeBtn.className = "copy-code-btn";
    copyCodeBtn.textContent = "Copy";
    return copyCodeBtn;
}

function handleCopyCode(copyCodeBtn, codeContainer) {
    const codeContent = codeContainer.textContent;
    navigator.clipboard.writeText(codeContent).then(() => {
        copyCodeBtn.textContent = "Copied!";
        copyCodeBtn.classList.add("copied");

        setTimeout(() => {
            copyCodeBtn.textContent = "Copy";
            copyCodeBtn.classList.remove("copied");
        }, 3000);
    });
}

function addCopyCodeBtnToCodeBox(codeBox) {
    const copyCodeBtn = createCopyCodeBtn();
    codeBox.appendChild(copyCodeBtn);

    copyCodeBtn.addEventListener("click", function () {
        const codeContainer = codeBox.querySelector("code");
        handleCopyCode(copyCodeBtn, codeContainer);
    });
}

function addCopyCodeBtnsToAllCodeBoxes() {
    const listCodeBox = document.querySelectorAll("pre");
    listCodeBox.forEach(addCopyCodeBtnToCodeBox);
}

addCopyCodeBtnsToAllCodeBoxes();
