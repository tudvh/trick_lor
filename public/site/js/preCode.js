const listPreCode = document.getElementsByTagName("pre");

const pathCopy =
    '<path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />';
const pathCopied =
    '<path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />';

function addCopyBtn(listPreCode) {
    for (var preCode of listPreCode) {
        //Add copy btn to pre
        preCode.innerHTML += `<svg  class="copy-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">${pathCopy}</svg>`;
        const copyBtn = preCode.querySelector("svg");

        //handle copy code
        copyBtn.addEventListener("click", function (e) {
            const codeContainer = copyBtn.parentElement.querySelector("code");
            const codeContent = codeContainer.textContent;

            navigator.clipboard.writeText(codeContent).then(() => {
                copyBtn.innerHTML = pathCopied;

                //setTime to return icon copy
                setTimeout(() => {
                    copyBtn.innerHTML = pathCopy;
                }, 3000);
            });
        });
    }
}
addCopyBtn(listPreCode);
