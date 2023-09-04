const myModal = new bootstrap.Modal(document.getElementById("preview"), {});

const rootURL = document.querySelector('meta[name="root-url"]').dataset.index;

const modalId = document.getElementById("preview");
console.log(myModal)

// Even on hidden modal,we reset content
modalId.addEventListener("hide.bs.modal", function () {
    document.getElementById('preview-content').innerHTML=""
});

// Show modal preview
document.getElementById('showPreView').addEventListener('click',(e)=>{
    
    var xhr = new XMLHttpRequest();
    var url = `${rootURL}/admin/posts/preview`
    xhr.open("POST", url);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('preview-content').innerHTML = xhr.responseText
            
            Prism.highlightAll();

            myModal.show();
        }
    };
    const selectedValues = Array.from(document.querySelector('#language-select').selectedOptions).map(option => option.value);
    
    const post={
        "title": document.getElementById('title').value,
        "youtube_id": document.getElementById('youtube-link').value,
        "description": tinymce.get('desc-textarea').getContent(),
        "_token":document.querySelector('input[name="_token"]').value,  
        "languages":selectedValues
    }
    var data = JSON.stringify(post);
    xhr.send(data);

    
})
