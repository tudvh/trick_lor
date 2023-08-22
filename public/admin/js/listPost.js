const rootURL = document.querySelector('meta[name="root-url"]').dataset.index
const searchElm = document.querySelector('input[name="search"]');
const languageElm = document.querySelector('select[name="language"]');
const statusElm = document.querySelector('select[name="status"]');

var searchValue='';
var languageValue='';
var statusValue='';



function getDataSearch(searchValue,languageValue,statusValue) {
    var xhr = new XMLHttpRequest();

    xml = new XMLHttpRequest();
    {
        xml.onreadystatechange = function() {
            if (xml.readyState == 4){          
                
                
                document.querySelector('.table-group-divider').innerHTML = xml.responseText;   

            }
         
        }   
        url = `${rootURL}/admin/posts/search?status=${statusValue}&title=${searchValue}&language=${languageValue}`;  
        console.log(url);    
        xml.open("GET", url, "false");
        xml.send();
    }
}

searchElm.addEventListener("input", function(){
    searchValue=searchElm.value;

    getDataSearch(searchValue,languageValue,statusValue);
});
languageElm.addEventListener("change", function(){
    languageValue=languageElm.value;
    getDataSearch(searchValue,languageValue,statusValue);
});
statusElm.addEventListener("change", function(){
    statusValue=statusElm.value;
    getDataSearch(searchValue,languageValue,statusValue);
});

const myModal = new bootstrap.Modal(document.getElementById("alertDelete"), {});
function togglePost(id){
    
    myModal.show();
    document.getElementById('accepShow').onclick=function(){
        
        location.href=`${rootURL}/admin/posts/setStatus/${id}`;
    }
    
}

