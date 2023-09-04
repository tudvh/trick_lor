const rootURL = document.querySelector('meta[name="root-url"]').dataset.index;
const searchElm = document.querySelector('input[name="search"]');
const languageElm = document.querySelector('select[name="language"]');
const statusElm = document.querySelector('select[name="status"]');

var searchValue = "";
var languageValue = "";
var statusValue = "";
var typingTimer;

// call ajax
function getDataSearch(searchValue, languageValue, statusValue) {
    var xml = new XMLHttpRequest();

    xml.onreadystatechange = function () {
        if (xml.readyState == 4) {
            document.querySelector(".table-group-divider").innerHTML =
                xml.responseText;
        }
    };

    url = `${rootURL}/admin/posts/search?status=${statusValue}&title=${searchValue}&language=${languageValue}`;
    xml.open("GET", url, "false");
    xml.send();
}

//get value search key
searchElm.addEventListener("input", function () {
    searchValue = searchElm.value;    
    clearTimeout(typingTimer);

    // Đặt timeout mới sau khi ngừng nhập trong 500ms
    typingTimer = setTimeout(function () {
        // Gọi hàm AJAX ở đây
        getDataSearch(searchValue, languageValue, statusValue);
    }, 500);
});

//get value languages
languageElm.addEventListener("change", function () {
    languageValue = languageElm.value;
    getDataSearch(searchValue, languageValue, statusValue);
});


//get value status
statusElm.addEventListener("change", function () {
    statusValue = statusElm.value;
    getDataSearch(searchValue, languageValue, statusValue);
});


const myModal = new bootstrap.Modal(document.getElementById("alertDelete"), {});
function togglePost(id) {
    myModal.show();
    document.getElementById("accepShow").onclick = function () {
        location.href = `${rootURL}/admin/posts/${id}/setStatus`;
    };
}
